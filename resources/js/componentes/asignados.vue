<template>
    <div>
        <div v-if="display == 'data'" class="card radius-10 w-100">
            <div class="card-body">
                <h5 class="mb-0">POBLACIÓN ASIGNADA</h5>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-floating me-3">
                            <select class="form-select" id="cm-1" aria-label="Floating label select example" v-model="area">
                                <option v-for="(are, i) in areas" :key="i" :value="are">{{ are.label }}</option>
                            </select>
                            <label for="cm-1">Seleccione el área</label>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th class="colmin px-2">No.</th>
                                <th class="colmin px-4">Identificación</th>
                                <th>Nombres y apellidos</th>
                                <th>Área</th>
                                <th>Evaluador</th>
                                <th>Encuesta</th>
                                <th class="colmin">Resultado</th>
                                <th class="colmin">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(elm, i) in getRegistros()" :key="i">
                                <td class="text-center">{{ i + 1 }}</td>
                                <td class="px-4">{{ elm.numdoc }}</td>
                                <td>{{ elm.name }}</td>
                                <td :class="targetArea == 'all'? '': 'bg-light-warning border border-warning'">{{ elm.area }}</td>
                                <td>{{ elm.responsable }}</td>
                                <td>
                                    <span class="df-flecha py-1 px-3 badge rounded-pill border border-success bg-light-success text-success" v-if="elm.id != null">
                                        <div class="d-flex align-items-center">
                                            <i class="bx bxs-like" style="font-size:1.2rem"></i>
                                            <span class="ms-1">{{ elm.formulario }}</span>
                                        </div>
                                    </span>
                                    <span class="df-flecha py-1 px-3 badge rounded-pill text-secondary" style="border:1px solid #DDD; background:#F0F0F0" v-else>
                                        <div class="d-flex align-items-center">
                                            <i class="bx bxs-dislike" style="font-size:1.1rem"></i>
                                            <span class="ms-1">Sin realizar</span>
                                        </div>
                                    </span>
                                </td>
                                <td class="text-center" style="font-size:1.2rem">
                                    <span :class="getPercentClass(elm.resultado)" v-if="elm.id != null">{{ elm.resultado }}%</span>
                                </td>
                                <td>
                                    <div class="d-flex order-actions justify-content-center" v-if="elm.id != null">
                                        <a class="btn-hover" href="#" title="Encuesta" v-on:click="openPoll(elm.id)"><i class='bx bx-right-arrow-circle'></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div :class="display == 'poll'? 'card radius-10 w-100': 'd-none'">
            <div class="card-body">
                <lc-reader ref="viewpoll" @close-poll="listen" :path="pathpoll"></lc-reader>
            </div>
        </div>
    </div>
</template>
<script>
import Plus from "./encuesta_reader_plus.vue";

export default {
    components: {'lc-reader': Plus},
    props: {
        mimetic: {type: String, default: ''},
        user: {type: String, default: ''},
        pathpoll: {type: String, default: ''}
    },
    data() {
        return {
            display: 'data',        // data | poll
            forms: [],
            dictForm: {},
            registros: [],
            areas: [],
            area: {'label': '', 'value': 'all'},
            targetArea: 'all',
            status: 'ini',
            status_add: 'ini',
            state: {'INI': 'ini', 'LOADING': 'loading', 'LOADED': 'loaded', 'FAILED': 'failed'}
        }
    },
    watch: {
        area: function(val){
            this.targetArea = val.value;
        }
    },
    methods: {
        clearData: (arg) => arg.replace(/(^\s+|\s+$)/g, '').replace(/\s{2,}/g, ' '),
        nospace: (arg) => arg.replace(/\s+/g, ''),
        is_empty: function(arg){
            return (['', null, undefined].indexOf(arg) >= 0)? true: false;
        },
        getPercentStatus: function(num){
            if(num >= 90){
                return 'SOBRESALIENTE';
            }else{
                return (num >= 80)? 'ACEPTABLE': 'CRÍTICO';
            }
        },
        getPercentClass: function(num){
            if(num >= 90){
                return 'px-3 py-2 badge rounded-pill bg-success text-white';
            }else{
                return (num >= 80)? 'px-3 py-2 badge rounded-pill bg-warning text-dark': 'px-3 py-2 badge rounded-pill bg-danger text-white';
            }
        },
        openPoll: function(idpoll){
            this.display = 'poll';
            this.$refs.viewpoll.setResponseId(idpoll);
        },
        loadForms: function(){
            axios.post(this.mimetic, {'tabla': 'formularios', 'campos': 'id,formulario'}).then(res => {
                this.forms = res.data;
                res.data.forEach(elm => this.dictForm[elm.formulario] = elm.id);
            }).catch(err => {console.log(err)});
        },
        getFormId: function(tx){
            var rul = new RegExp(tx, 'i');
            var elm = this.forms.filter(el => rul.test(el.formulario));
            return (elm.length > 0)? elm[0].id: null;
        },
        getRegistros: function(){
            return (this.targetArea == 'all')? this.registros: this.registros.filter(elm => elm.area == this.targetArea);
        },
        loadPeople: function(){
            this.status = this.state.LOADING;
            let campos = "users.name AS responsable, poblacion.numdoc, poblacion.name, poblacion.area, formularios.formulario, formularios_response.cargo, formularios_response.resultado, formularios_response.id";
            let junta = "users:poblacion.user_id:users.id|formularios:poblacion.formulario_id:formularios.id:left|formularios_response:poblacion.numdoc:formularios_response.numdoc:left";
            axios.post(this.mimetic, {'tabla': 'poblacion', 'join': junta, 'campo1': 'poblacion.user_id', 'valor1': this.user, 'campos': campos}).then(res => {
                this.registros = res.data;
                let tmp = {};
                res.data.forEach(elm => {
                    if(this.is_empty(elm.area)){
                        tmp['-void-'] = '';
                    }else{
                        tmp[elm.area] = '';
                    }
                });
                this.areas = Object.keys(tmp).map(elm => elm == '-void-'? ({'label': 'Sin área asignada', 'value': null}): ({'label': elm, 'value': elm})).sort((a, b) => b.label - a.label);
                this.areas.unshift({'label': '', 'value': 'all'});
                this.status = this.state.LOADED;
            }).catch(err => {
                console.log(err);
                this.status = this.state.FAILED;
            });
        },
        listen: function(arg){
            this.display = 'data';
        }
    },
    mounted() {
        this.loadForms();
        this.loadPeople();
    }
}
</script>
<style scoped>
.fx-border-hover:hover {border-color: #008CFF !important}
.colmin {width: 1%; white-space: nowrap; text-align: center}
.text-none {color:#BDBCBC; opacity: .7}
.df-flecha {cursor:default; user-select: none}
</style>