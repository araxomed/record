<template>
    <div class="row">
        <div class="col-sm-4">
            <ul class="list-group">
                <li :class="indice == elm.hash? 'list-group-item active': 'list-group-item'" v-for="(elm, i) in schema" :key="i" @click="setComp(elm)">
                    {{ elm.comp }}
                    <!-- <span class="badge rounded-pill"></span> -->
                </li>
            </ul>
        </div>
        <div class="col-sm-8">
            <am-barra ref="xiom"></am-barra>
        </div>
    </div>
</template>
<script>
import Barra from "./am_pie.vue";

export default {
    components: {'am-barra': Barra},
    props: {
        mimetic: {type: String, default: ''},
        user: {type: String, default: ''},
    },
    data(){
        return {
            tags: {'1': 'Deficiente', '2': 'Malo', '3': 'Regular', '4': 'Bueno', '5': 'Excelente'},
            colores: {'1': '#EE6666', '2': '#F79B4D', '3': '#FFCE34', '4': '#82C042', '5': '#00B050'},
            poll_id: 1,
            formulario: null,
            items: [],
            hash_comps: {},
            hash_items: {},
            num_responses: 0,
            schema: [],
            targetComp: null,
            indice: 0,
        }
    },
    methods: {
        loadItems: function(){
            axios.post(this.mimetic + '/data/items', {'id': this.poll_id}).then(res => {
                this.formulario = res.data.form;
                this.items = res.data.items;
                let ik = 0;
                this.schema = [];
                this.hash_comps = {};
                this.hash_items = {};
                this.items.forEach(elm => {
                    if(elm.tipo == 'title'){
                        ik++;
                        // this.schema.push({'comp': elm.item, 'hash': ik, 'num_items': 0, 'opciones': []});
                        this.hash_comps[ik] = {'comp': elm.item, 'hash': ik, 'num_items': 0, 'opciones': [], 'values': {'1': 0, '2': 0, '3': 0, '4': 0, '5': 0}};
                    }
                    if(ik > 0 && elm.tipo == 'num'){
                        this.hash_items[elm.id] = {'comp': ik, 'id': elm.id}
                        this.hash_comps[ik].num_items++;
                    }
                });
                console.log(this.items);
                this.loadResponses();
                // Schema
                // {item: '', component: 0, }
                // res.data.items.forEach(elm => console.log(elm.orden + ': ' + elm.tipo));
            }).catch(err => console.log(err));
        },
        loadResponses: function(){
            axios.post(this.mimetic + '/data/response/chart', {'user_id': this.user}).then(res => {
                this.num_responses = res.data.total;
                res.data.datos.forEach(elm => {
                    let hash = this.hash_items[elm.item_id].comp;
                    this.hash_comps[hash].values[elm.valor]++;
                    // this.hash_items[elm.item_id].values[elm.valor]++;
                });
                this.schema = Object.values(this.hash_comps).map(elm => {
                    let divisor = elm.num_items * this.num_responses;
                    elm.opciones = Object.entries(elm.values).map(pair => {
                        let valor = (pair[1] / divisor) * 100;
                        if(valor % 1 != 0){
                            valor = parseFloat(valor.toFixed(2));
                        }
                        return {'categoria': this.tags[pair[0]], 'valor': pair[1], 'total': valor, 'color': this.colores[pair[0]]};
                    });
                    return elm;
                });
                console.log('Schema ▼');
                console.log(this.schema);
                if(this.schema.length > 0){
                    this.setComp(this.schema[0])
                }
                this.$refs.xiom.setDatos(this.schema[0].opciones);
            }).catch(err => {console.log(err)});
        },
        setComp: function(elm){
            this.targetComp = elm;
            this.indice = this.targetComp.hash;
            this.$refs.xiom.setDatos(this.targetComp.opciones);
        }
    },
    mounted(){
        // this.loadItems();
    }
}
</script>