<template>
    <div>
        <div class="d-flex align-items-center justify-content-between border-bottom mb-4 pb-2">
            <div v-if="form != null">
                <h5 class="mb-0 text-uppercase">{{ form.formulario }}</h5>
                <div class="text-secondary font-13">Encuesta del área de {{ form.area }}</div>
            </div>
            <div v-else></div>
            <div class="font-22" v-on:click="closePoll()">
                <i class="bx bx-x"></i>
            </div>
        </div>
        <div class="row mb-3 pe-none" v-if="response != null">
            <div class="col-sm-6">
                <div class="form-floating">
                    <input type="text" class="form-control" id="tz-1" autocomplete="off" :value="getFecha(response.created_at)">
                    <label for="tz-1">Fecha de diligenciamiento:</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating">
                    <input type="text" class="form-control" id="tz-1" autocomplete="off" :value="getFecha(response.updated_at)">
                    <label for="tz-1">Fecha de última actualización:</label>
                </div>
            </div>
        </div>
        <div class="row mb-3 pe-none">
            <div class="col-sm-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="tx-0" autocomplete="off" v-model="datos['name']">
                    <label for="tx-0">Empleado:</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="tx-1" autocomplete="off" v-model="datos['numdoc']">
                    <label for="tx-1">Identificación:</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="tx-2" autocomplete="off" v-model="datos['cargo']">
                    <label for="tx-2">Cargo:</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="tx-3" autocomplete="off" v-model="datos['rol']">
                    <label for="tx-3">Rol ocupacional:</label>
                </div>
            </div>
        </div>
        <div class="form-floating mb-3 pe-none">
            <textarea class="form-control" id="tx-4" style="height: 100px" v-model="datos['mision']"></textarea>
            <label for="tx-4">Misión del cargo:</label>
        </div>
        <table class="table table-bordered pe-none">
            <tbody>
                <tr>
                    <td style="border-top:1px solid transparent; border-left:1px solid transparent"></td>
                    <td class="colmin bg-warning py-0">Deficiente</td>
                    <td class="colmin bg-warning py-0">Malo</td>
                    <td class="colmin bg-warning py-0">Regular</td>
                    <td class="colmin bg-warning py-0">Bueno</td>
                    <td class="colmin bg-warning py-0">Excelente</td>
                </tr>
                <tr v-for="(elm, i) in items" :key="i" :class="css_all[elm.tipo]">
                    <td :colspan="elm.tipo == 'are'? 6: 1">
                        <div class="form-floating" v-if="elm.tipo == 'are'">
                            <textarea class="form-control" :id="'ta-' + elm.id" style="height: 100px" v-model="datos[elm.field]"></textarea>
                            <label :for="'ta-' + elm.id">{{ elm.item }}</label>
                        </div>
                        <span v-else>{{ elm.item }}</span>
                    </td>
                    <td :class="'text-center cell-rad td_' + elm.tipo">
                        <span class="px-4" v-if="elm.tipo == 'title'">1</span>
                        <div class="form-radom" v-else-if="elm.tipo == 'num'">
                            <input type="radio" :id="'rad_1_' + i" :name="'rad_' + i" value="1" v-model="datos[elm.field]">
                            <label :for="'rad_1_' + i"></label>
                        </div>
                    </td>
                    <td :class="'text-center cell-rad td_' + elm.tipo">
                        <span class="px-4" v-if="elm.tipo == 'title'">2</span>
                        <div class="form-radom" v-else-if="elm.tipo == 'num'">
                            <input type="radio" :id="'rad_2_' + i" :name="'rad_' + i" value="2" v-model="datos[elm.field]">
                            <label :for="'rad_2_' + i"></label>
                        </div>
                    </td>
                    <td :class="'text-center cell-rad td_' + elm.tipo">
                        <span class="px-4" v-if="elm.tipo == 'title'">3</span>
                        <div class="form-radom" v-else-if="elm.tipo == 'num'">
                            <input type="radio" :id="'rad_3_' + i" :name="'rad_' + i" value="3" v-model="datos[elm.field]">
                            <label :for="'rad_3_' + i"></label>
                        </div>
                    </td>
                    <td :class="'text-center cell-rad td_' + elm.tipo">
                        <span class="px-4" v-if="elm.tipo == 'title'">4</span>
                        <div class="form-radom" v-else-if="elm.tipo == 'num'">
                            <input type="radio" :id="'rad_4_' + i" :name="'rad_' + i" value="4" v-model="datos[elm.field]">
                            <label :for="'rad_4_' + i"></label>
                        </div>
                    </td>
                    <td :class="'text-center cell-rad td_' + elm.tipo">
                        <span class="px-4" v-if="elm.tipo == 'title'">5</span>
                        <div class="form-radom" v-else-if="elm.tipo == 'num'">
                            <input type="radio" :id="'rad_5_' + i" :name="'rad_' + i" value="5" v-model="datos[elm.field]">
                            <label :for="'rad_5_' + i"></label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-center mb-4 mt-5" v-if="response != null">
            <div :class="'card mb-3 text-center ' + getPercentBorder(response.resultado)" style="max-width: 18rem;">
                <div :class="'card-header fw-bold ' + getPercentClass(response.resultado)">{{ getPercentStatus(response.resultado) }}</div>
                <div class="card-body">
                    <p class="mb-0">Resultado de la encuesta</p>
                    <h3 class="mb-0 fs-1">{{ response.resultado }}%</h3>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mb-4 d-none">
            <button type="button" class="btn btn-primary bg-gradient px-4 py-3" disabled>
                <i class="bx bx-save fs-3"></i>
                <div style="font-size:.75rem; letter-spacing:2px">Guardar encuesta</div>
            </button>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        path: {type: String, default: ''},
        pathwrite: {type: String, default: ''},
        pathpanel: {type: String, default: ''},
        employee: {type: String, default: ''},
        cedula: {type: String, default: ''},
        display: {type: String, default: 'write'}   // write | read | preview
    },
    data() {
        return {
            css_all: {'title': 'bg-success fw-bold text-white font-title', 'sub': 'bg-custom fw-bold row-sub', 'num': 'row-num', 'are': ''},
            response_id: '',
            form: null,
            response: null,
            items: [],
            datos: {'formulario_id': '', 'name': '', 'numdoc': '', 'cargo': '', 'rol': '', 'mision': ''},  // Fill dinamically...
            summary: {'total': 0, 'pendientes': 0},
            status: 'ini',
            state: {'INI': 'ini', 'LOADING': 'loading', 'LOADED': 'loaded', 'FAILED': 'failed'}
        }
    },
    methods: {
        isEmpty: function(arg){
            return (arg == '')? true: false;
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
                return 'bg-success text-white';
            }else{
                return (num >= 80)? 'bg-warning text-dark': 'bg-danger text-white';
            }
        },
        getPercentBorder: function(num){
            if(num >= 90){
                return 'border border-success';
            }else{
                return (num >= 80)? 'border border-warning': 'border border-danger';
            }
        },
        getFecha: function(arg){
            return (arg != undefined && arg != null) ? arg.slice(0, 10): "";
        },
        loadForm: function(){
            this.status = this.state.LOADING;
            axios.post(this.path, {'response_id': this.response_id}).then(res => {
                this.form = res.data.form;
                if(res.data.response != null){
                    this.response = res.data.response;
                    this.datos['name'] = this.response.name;
                    this.datos['numdoc'] = this.response.numdoc;
                    this.datos['cargo'] = this.response.cargo;
                    this.datos['rol'] = this.response.rol;
                    this.datos['mision'] = this.response.mision;
                }
                this.items = res.data.items.map(elm => {
                    if(elm.tipo != 'title' && elm.tipo != 'sub'){
                        elm.field = 'key_' + elm.tipo + '_' + elm.id;
                        if(elm.data_id != null){
                            this.datos[elm.field] = (elm.tipo == 'num')? elm.valor: elm.texto;
                        }else{
                            this.datos[elm.field] = '';
                        }
                    }
                    return elm;
                });
                this.status = this.state.LOADED;
            }).catch(err => {
                console.log(err);
                this.status = this.state.FAILED;
            })
        },
        setResponseId: function(id){
            this.response_id = id;
            this.loadForm();
        },
        closePoll: function(){
            this.$emit('closePoll', 'success');
        }
    },
    mounted() {
        this.css_all.title = 'bg-primary fw-bold text-white font-title';
        //this.loadForm();
    }
}
</script>
<style scoped>
.colmin {width: 1%; white-space: nowrap}
.table.table-bordered td {border:1px solid #444}
.bg-custom {background:#EBEBEB; font-size:.85rem; letter-spacing: 1px !important}
.table.table-bordered .bg-custom > td {border-left-color: #999; border-right-color: #999}
.table.table-bordered .bg-custom > td:first-child {border-left-color: #444}
.table.table-bordered .bg-custom > td:last-child {border-right-color: #444}
.font-title {font-size: 1rem}
tr.row-sub td {padding-top:1px; padding-bottom: 0px;}
tr.row-num:hover {background: #E4EFFF66}
tr.row-num td.cell-rad:hover {background: #FFF3CD}
td.td_are {display:none}
.form-radom  > input {display: none; text-align: center;}
.form-radom > input + label, .radom {display:inline-block; border:1px solid #777; border-radius: 50%; width:20px; height:20px; box-sizing: border-box; transition: border .1s; background:#FFF}
.form-radom > input:checked + label, .radom.radom-focus {border:7px solid #008CFF}
</style>