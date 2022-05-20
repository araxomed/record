<template>
    <div class="row">
        <div class="col-sm-6">
            <div class="card radius-10 w-100 text-center">
                <div class="card-body" v-if="poll != null">
                    <h3 class="mb-0 font-weight-bold text-center">{{ poll.formulario }}</h3>
                    <div class="font-9 text-center">Nombre de la encuesta</div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <div>
                                <p class="mb-0 text-secondary">Encuestas diligenciadas</p>
                                <h3 class="my-0 fw-bold">{{ lc_total }}</h3>
                            </div>
                        </div>
                        <div class="col-sm-4 border-start">
                            <div>
                                <p class="mb-0 text-secondary">Total población</p>
                                <h3 class="my-0 fw-bold">{{ lc_poblacion }}</h3>
                            </div>
                        </div>
                        <div class="col-sm-4 border-start">
                            <div>
                                <p class="mb-0 text-secondary">% de avance</p>
                                <h3 class="my-0 fw-bold">{{ getAvance() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item" v-for="(aco, i) in items" :key="i">
                    <h2 class="accordion-header" :id="'heading-' + i">
                    <button :class="(i == 0)? 'accordion-button': 'accordion-button collapsed'" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapse-' + i" :aria-expanded="(i == 0)? true: false" :aria-controls="'collapse-' + i">
                        {{ aco.section }}
                    </button>
                    </h2>
                    <div :id="'collapse-' + i" :class="(i == 0)? 'accordion-collapse collapse show': 'accordion-collapse collapse'" :aria-labelledby="'heading-' + i" data-bs-parent="#accordionExample">
                        <div class="accordion-body px-0">
                            <ul class="list-group list-group-flush">
                                <li :class="item_id == elem.id? 'list-group-item active': 'list-group-item'" v-for="(elem, k) in aco.data" :key="k" v-on:click="setItem(elem, aco.section)">{{ elem.item}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END ACCORDION -->
        </div>
        <div class="col-sm-6">
            <div class="card radius-10 w-100 border border-primary">
                <h5 class="card-header py-3 bg-light-primary" style="background:#F5F5F5">{{ targetSection }}</h5>
                <div class="card-body">
                    <h5 class="mt-3 mb-4 title-chart" v-if="targetItem != null">{{ targetItem.item }}</h5>
                    <lc-torta ref="gp1" radio="50" altura="340px"></lc-torta>
                    <table class="table table-sm align-middle mt-4" v-if="status_item == state.LOADED">
                        <thead>
                            <tr>
                                <th>Nivel</th>
                                <th class="colmin">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(elm, i) in schema" :key="i">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span :class="'me-2 square-' + elm.num"><i class='bx bxs-square fs-5'></i></span>
                                        <span>{{ elm.categoria }}</span>
                                    </div>
                                </td>
                                <td class="text-center">{{ elm.total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- END ROW -->
</template>
<script>
import TLC from "./am_pie.vue";
export default {
    components: {
        'lc-torta': TLC
    },
    props: {
        mimetic: {type: String, default: ''},
        keydata: {type: String, default: ''},
        pathitem: {type: String, default: ''},
        bigtotal: {type:String, default: '0'},
        poblacion: {type: String, default: '0'}
    },
    data() {
        return {
            lc_total: 0,
            lc_poblacion: 0,
            poll: null,
            items: [],
            targetSection: '',
            targetItem: null,
            item_id: -1,
            schema: {
                '1': {'categoria': 'Deficiente', 'total': 0, 'num': 1, 'color': '#EE6666'},
                '2': {'categoria': 'Malo', 'total': 0, 'num': 2, 'color': '#F79B4D'},
                '3': {'categoria': 'Regular', 'total': 0, 'num': 3, 'color': '#FFCE34'},
                '4': {'categoria': 'Bueno', 'total': 0, 'num': 4, 'color': '#82C042'},
                '5': {'categoria': 'Excelente', 'total': 0, 'num': 5, 'color': '#00B050'}
            },
            status: 'ini',
            status_item: 'ini',
            state: {'INI': 'ini', 'LOADING': 'loading', 'LOADED': 'loaded', 'FAILED': 'failed'}
        }
    },
    methods: {
        getAvance: function(){
            var num = (this.lc_total / this.lc_poblacion) * 100;
            return ((num % 1) == 0)? num + '%': (num).toFixed(1) + '%';
        },
        loadPoll: function(){
            axios.post(this.mimetic, {'tabla': 'formularios', 'find': this.keydata}).then(res => {
                this.poll = res.data;
                console.log(this.poll);
                this.loadItems();
            }).catch(err => {
                console.log(err);
            });
        },
        loadItems: function(){
            if(this.poll != null){
                var pam = {'tabla': 'formularios_items', 'campo1': 'formulario_id', 'valor1': this.poll.id, 'orden': 'orden'};
                this.items = [];
                axios.post(this.mimetic, pam).then(res => {
                    let indice = -1;
                    res.data.forEach(elm => {
                        if(elm.tipo == 'title'){
                            this.items.push({'section': elm.item, 'data': []});
                            indice++;
                        }
                        if(elm.tipo == 'num' && indice >= 0){
                            this.items[indice].data.push(elm);
                        }
                    });
                    if(this.items.length > 0){
                        if(this.items[0].data.length > 0){
                            this.setItem(this.items[0].data[0], this.items[0].section);
                        }
                    }
                }).catch(err => {
                    console.log(err);
                });
            }
        },
        loadDataGraph: function(kid){
            this.status_item = this.state.LOADING;
            axios.post(this.pathitem, {'id': kid}).then(res => {
                ['1', '2', '3', '4', '5'].forEach(elm => this.schema[elm].total = 0);
                res.data.forEach(elm => {
                    if(this.schema[elm.valor] != undefined){
                        this.schema[elm.valor].total = elm.total;
                    }
                });
                this.status_item = this.state.LOADED;
                this.$refs.gp1.setDatos(Object.values(this.schema).filter(elm => elm.total > 0));
            }).catch(err => {
                this.status_item = this.state.FAILED;
                console.log(err);
            });
        },
        setItem: function(it, sec){
            this.targetSection = sec;
            this.targetItem = it;
            this.item_id = it.id;
            this.loadDataGraph(this.item_id);
        }
    },
    mounted() {
        this.lc_total = parseInt(this.bigtotal);
        this.lc_poblacion = parseInt(this.poblacion);
        this.loadPoll();
    }
}
</script>
<style scoped>
.colmin {width:1%; white-space: nowrap; text-align: center}
.accordion-button.collapsed {background:linear-gradient(#FBFBFB, #E3E3E3, #F3F3F3)}
/* .accordion-button:not(.collapsed) {background: #0890FF; color:#FFF} */
.list-group-item {cursor:pointer; user-select: none}
.list-group-item:not(.active):hover {background:#F8F8F8}
.title-chart {font-size:1rem; letter-spacing: 2px; text-align: center}
.square-1 {color:#EE6666}
.square-2 {color:#F79B4D}
.square-3 {color:#FFCE34}
.square-4 {color:#82C042}
.square-5 {color:#00B050}
.table thead>tr>th {border-bottom: 2px solid #CDD1D5 !important}
</style>