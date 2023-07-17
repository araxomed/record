<template>
    <div>
        <div :class="display == 'data'? 'card radius-10 shadow-nonex w-100 border': 'd-none'">
            <div class="card-header pt-3" style="background:#EFEFEF">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a :class="subdisplay == 'table'? 'nav-link active': 'nav-link'" href="javascript:void(0)" @click="setSubdisplay('table')">Población asignada</a>
                    </li>
                    <li class="nav-item">
                        <a :class="subdisplay == 'gp-asign'? 'nav-link active': 'nav-link disabled'" href="javascript:void(0)" @click="setSubdisplay('gp-asign')">Resumen asignados</a>
                    </li>
                    <li class="nav-item">
                        <a :class="subdisplay == 'gp-general'? 'nav-link active': 'nav-link disabled'" href="javascript:void(0)" @click="setSubdisplay('gp-general')">Resumen general</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div :class="subdisplay == 'table'? '': 'd-none'">
                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <div class="form-floating me-3">
                                <select class="form-select" id="cm-1" aria-label="Floating label select example" v-model="area">
                                    <option v-for="(are, i) in areas" :key="i" :value="are">{{ are.label }}</option>
                                </select>
                                <label for="cm-1">Seleccione el área</label>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-4" v-if="status == state.LOADED && registros.length > 0">
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
                                    <td class="px-1">
                                        <div class="d-flex order-actions justify-content-center" v-if="elm.id != null">
                                            <a class="btn-hover me-2" href="#" title="Editar" v-on:click="openPollEdit(elm.id)"><i class='bx bx-edit-alt'></i></a>
                                            <a class="btn-hover" href="#" title="Encuesta" v-on:click="openPoll(elm.id)"><i class='bx bx-right-arrow-circle'></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-if="status == state.LOADED && registros.length == 0" class="alert alert-warning mt-4">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-error me-2 fs-4"></i>
                            <p class="mb-0">No tiene población asignada!</p>
                        </div>
                    </div>
                </div>
                <!-- End subdisplay TABLE -->
                <div :class="subdisplay == 'gp-asign'? '': 'd-none'">
                    <lc-graphics :mimetic="mimetic" :user="user"></lc-graphics>
                </div>
                <!-- End subdisplay GP-ASIGN -->
            </div>
        </div>
        <div :class="display == 'poll'? 'card radius-10 w-100': 'd-none'">
            <div class="card-body">
                <lc-reader ref="viewpoll" @close-poll="listen" :path="pathpoll" :mimetic="mimetic"></lc-reader>
            </div>
        </div>
    </div>
</template>
<script>
import Plus from "./encuesta_reader_plus.vue";
import Plas from "./chart_component.vue";

export default {
    components: {'lc-reader': Plus, 'lc-graphics': Plas},
    props: {
        mimetic: {type: String, default: ''},
        user: {type: String, default: ''},
        pathpoll: {type: String, default: ''}
    },
    data() {
        return {
            display: 'data',        // data | poll
            subdisplay: 'table',    // table | gp-asign | gp-general
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
            this.$refs.viewpoll.setDisplay('read');
            this.$refs.viewpoll.setResponseId(idpoll);
            this.display = 'poll';
        },
        openPollEdit: function(idpoll){
            this.$refs.viewpoll.setDisplay('edit');
            this.$refs.viewpoll.setResponseId(idpoll);
            this.display = 'poll';
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
            let campos = "users.name AS responsable, poblacion.numdoc, poblacion.name, poblacion.area, form_active_view.formulario, response_active_view.cargo, response_active_view.resultado, response_active_view.id";
            let junta = [
                "users:poblacion.user_id:users.id",
                "form_active_view:poblacion.formulario_id:form_active_view.id:left",
                "response_active_view:poblacion.numdoc:response_active_view.numdoc:left"
            ].join('|');
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
        setSubdisplay: function(arg){
            // if(['table', 'gp-asign', 'gp-general'].includes(arg)){
            //     this.subdisplay = arg;
            // }
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