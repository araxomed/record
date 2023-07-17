<template>
    <div>
        <table :class="'table table-bordered ' + status">
            <thead>
                <tr>
                    <th>Evaluadores</th>
                    <th>Población</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-0 py-0" style="width:30%">
                        <div class="list-group">
                            <a href="javascript:void(0)" :class="compareUser(elm)? css + ' active': css" v-for="(elm, i) in datos" :key="i" @click="setTargetUser(elm)">
                                {{ elm.name }}
                                <span :class="cssBadge(compareUser(elm), elm.poblacion.length)">{{ elm.poblacion.length }}</span>
                            </a>
                        </div>
                    </td>
                    <td class="px-0 py-0" style="width:30%">
                        <ul class="list-group list-group-flush" v-if="targetUser != null">
                            <li class="list-group-item" v-for="(pob, i) in targetUser.poblacion" :key="i"><strong>{{ pob.numdoc }}</strong> - {{ pob.persona }}</li>
                        </ul>
                        <div class="text-center mt-2">
                            <a href="javascript:void(0)" @click="prepaste"><i class="bx bx-copy-alt"></i> Copiar cédulas</a>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="" class="control-label">Documentos de la población:</label>
                            <textarea rows="5" class="form-control" v-model="f_docs"></textarea>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary rounded-0" @click="loadPoblacion">Consultar</button>
                        </div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item" v-for="(elm, i) in poblacion" :key="i">
                                <strong>
                                    {{ elm.numdoc }}
                                </strong>
                                {{ elm.name }}
                            </div>
                        </div>
                        <div :class="poblacion.length > 0? 'btn-group d-flex mt-4': 'd-none'">
                            <button class="btn btn-danger" @click="reasignPoblacion('none')">Quitar evaluador</button>
                            <button class="btn btn-primary" @click="reasignPoblacion('ok')" :disabled="targetUser == null">Asignar evaluador</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    props: {
        mimetic: {type: String, default: ''},
    },
    data() {
        return {
            css: 'list-group-item list-group-item-action d-flex justify-content-between align-items-center',
            targetUser: null,
			datos: [],
            poblacion: [],
            f_docs: '',
            status: 'ini',
            state: {'INI': 'ini', 'LOADING': 'loading', 'LOADED': 'loaded', 'FAILED': 'failed'}
        }
    },
    methods: {
		isEmpty: function(arg){
			return ['', undefined, null].includes(arg)? true: /^\s*$/.test(arg);
		},
        setTargetUser: function(arg){
            this.targetUser = arg;
        },
        compareUser: function(arg){
            if(this.isEmpty(this.targetUser)){
                return false;
            }
            return this.targetUser.id == arg.id;
        },
        cssBadge: function(bool, num){
            let pri = 'badge bg-success badge-pill';
            if(bool){
                pri = 'badge bg-secondary badge-pill';
            }
            return (num > 0)? pri: 'badge bg-danger badge-pill';
        },
        prepaste: function(){
            if(this.targetUser != null){
                let tx = this.targetUser.poblacion.map(elm => elm.numdoc).join("\n");
                navigator.clipboard.writeText(tx);
            }
        },
        loadData: function(){
            if(this.status != this.state.LOADING){
                this.status = this.state.LOADING;
                axios.post(this.mimetic + '/by/user').then(res => {
                    let tm = {};
                    res.data.forEach(elm => {
                        if(tm[elm.id] == undefined){
                            tm[elm.id] = {'id': elm.id, 'name': elm.name, 'email': elm.email, 'rol': elm.rol, 'poblacion': []};
                        }
                        if(elm.numpob == 1){
                            tm[elm.id].poblacion.push({'numdoc': elm.numdoc, 'persona': elm.persona});
                        }
                    });
                    this.datos = Object.values(tm).sort((a, b) => this.sortAsc(a.name, b.name));
                    if(this.datos.length > 0){
                        this.targetUser = this.datos[0];
                    }
                    this.status = this.state.LOADED;
                }).catch(err => {
                    this.status = this.state.FAILED;
                    console.log(err);
                });
            }
        },
        loadPoblacion: function(){
            if(this.status != this.state.LOADING){
                this.status = this.state.LOADING;
                this.poblacion = [];
                let numdocs = this.f_docs.split("\n").join(',');
                axios.post(this.mimetic + '/by/numdocs', {'numdocs': numdocs}).then(res => {
                    console.log('hola ie');
                    console.log(res.data);
                    this.poblacion = res.data;
                    this.status = this.state.LOADED;
                }).catch(err => {
                    this.status = this.state.FAILED;
                    console.log(err);
                });
            }
        },
        reasignPoblacion: function(mode){
            if(this.status != this.state.LOADING){
                this.status = this.state.LOADING;
                let numdocs = this.poblacion.map(elm => elm.numdoc).join(',');
                let destino = (mode == 'none')? 'none': this.targetUser.id;
                axios.post(this.mimetic + '/reasign/poblacion', {'numdocs': numdocs, 'destino': destino}).then(res => {
                    console.log('estrada');
                    console.log(res.data);
                    this.status = this.state.LOADED;
                    this.poblacion = [];
                    this.f_docs = '';
                    this.loadData();
                }).catch(err => {
                    console.log(err);
                    this.status = this.state.FAILED;
                });
            }
        },
        sortAsc: function(a, b){
            if(a == b){
                return 0;
            }
            return (a < b)? -1: 1;
        }

    },
    mounted() {
        this.loadData();
    }
}
</script>
<style scoped>
    .loading {opacity: .45; pointer-events: none !important}
    table.table.table-bordered td {border:2px solid #000}
    .colmin {width: 1%; white-space: nowrap; text-align: center}
    .list-group > .list-group-item {border-left: none !important; border-right: none !important}
</style>
