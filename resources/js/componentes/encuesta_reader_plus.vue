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
        <table :class="lc_display == 'edit'? 'table table-bordered': 'table table-bordered pe-none'">
            <tbody v-if="lc_display == 'read'">
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
                        <div v-else>{{ elm.item }}</div>
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
            <tbody v-else-if="lc_display == 'edit'">
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
                        <div v-if="elm.tipo == 'are'">
                            <div class="form-floating">
                                <textarea class="form-control" :id="'ta-' + elm.id" style="height: 100px" v-model="datos[elm.field]" disabled></textarea>
                                <label :for="'ta-' + elm.id">{{ elm.item }}</label>
                            </div>
                            <a href="javascript:void(0)" class="me-2 mb-4" title="Editar" @click="openEditArea(elm)"><i class='bx bx-edit-alt'></i> Editar</a>
                        </div>
                        <div v-else>
                            <a href="javascript:void(0)" class="me-2" title="Editar" v-if="elm.tipo == 'num'" @click="openEdit(elm)"><i class='bx bx-edit-alt'></i></a>{{ elm.item }}
                        </div>
                    </td>
                    <td :class="'pe-none text-center cell-rad td_' + elm.tipo">
                        <span class="px-4" v-if="elm.tipo == 'title'">1</span>
                        <div class="form-radom" v-else-if="elm.tipo == 'num'">
                            <input type="radio" :id="'rad_1_' + i" :name="'rad_' + i" value="1" v-model="datos[elm.field]">
                            <label :for="'rad_1_' + i"></label>
                        </div>
                    </td>
                    <td :class="'pe-none text-center cell-rad td_' + elm.tipo">
                        <span class="px-4" v-if="elm.tipo == 'title'">2</span>
                        <div class="form-radom" v-else-if="elm.tipo == 'num'">
                            <input type="radio" :id="'rad_2_' + i" :name="'rad_' + i" value="2" v-model="datos[elm.field]">
                            <label :for="'rad_2_' + i"></label>
                        </div>
                    </td>
                    <td :class="'pe-none text-center cell-rad td_' + elm.tipo">
                        <span class="px-4" v-if="elm.tipo == 'title'">3</span>
                        <div class="form-radom" v-else-if="elm.tipo == 'num'">
                            <input type="radio" :id="'rad_3_' + i" :name="'rad_' + i" value="3" v-model="datos[elm.field]">
                            <label :for="'rad_3_' + i"></label>
                        </div>
                    </td>
                    <td :class="'pe-none text-center cell-rad td_' + elm.tipo">
                        <span class="px-4" v-if="elm.tipo == 'title'">4</span>
                        <div class="form-radom" v-else-if="elm.tipo == 'num'">
                            <input type="radio" :id="'rad_4_' + i" :name="'rad_' + i" value="4" v-model="datos[elm.field]">
                            <label :for="'rad_4_' + i"></label>
                        </div>
                    </td>
                    <td :class="'pe-none text-center cell-rad td_' + elm.tipo">
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
    <div class="modal fade" id="edKate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" v-if="targetItem != null">
                <div class="modal-header" style="background:#F3F3F3">
                    <h5 class="modal-title">Editar pregunta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <small>Pregunta:</small>
                    <p class="fw-bold">{{ targetItem.item }}</p>
                    <hr>
                    <div v-for="(elm, i) in ranums" :key="i" class="d-flex align-items-center mb-2" style="cursor:default">
                        <span :class="elm.value == num_suma_alt? 'radom radom-focus': 'radom'" @click="setValueItem(elm.value)"></span>
                        <span :class="elm.value == num_suma_alt? 'fw-bold text-primary ms-2': 'ms-2 teke'">{{ elm.value + ' - ' + elm.label}}</span>
                    </div>
                    <div class="text-center fs-4">{{ result_temp }}%</div>
                </div>
                <div class="modal-footer" style="background:#F7F7F7">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" @click="saveEdit" :disabled="targetItem.valor == num_suma_alt">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edKati" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" v-if="targetItem != null">
                <div class="modal-header" style="background:#F3F3F3">
                    <h5 class="modal-title">Editar pregunta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <textarea class="form-control" id="edkati_texto" style="height: 100px" v-model="f_texto"></textarea>
                        <label for="edkati_texto">{{ targetItem.item }}</label>
                    </div>
                </div>
                <div class="modal-footer" style="background:#F7F7F7">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" @click="saveEditText" :disabled="is_valid_text == false">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        mimetic: {type: String, default: ''},
        path: {type: String, default: ''},
        pathwrite: {type: String, default: ''},
        pathpanel: {type: String, default: ''},
        employee: {type: String, default: ''},
        cedula: {type: String, default: ''},
        display: {type: String, default: 'read'}   // write | read | preview | edit
    },
    data() {
        return {
            lc_display: this.display,
            css_all: {'title': 'bg-success fw-bold text-white font-title', 'sub': 'bg-custom fw-bold row-sub', 'num': 'row-num', 'are': ''},
            ranums: [{'label': 'Deficiente', 'value': 1}, {'label': 'Malo', 'value': 2}, {'label': 'Regular', 'value': 3}, {'label': 'Bueno', 'value': 4}, {'label': 'Excelente', 'value': 5}],
            response_id: '',
            form: null,
            response: null,
            targetItem: null,
            num_total: 0,
            num_suma: 0,
            num_suma_alt: 0,
            f_texto: '',
            result_temp: 0,
            items: [],
            num_fields: [],
            datos: {'formulario_id': '', 'name': '', 'numdoc': '', 'cargo': '', 'rol': ''},  // Fill dinamically...
            summary: {'total': 0, 'pendientes': 0},
            status: 'ini',
            status_edit: 'ini',
            state: {'INI': 'ini', 'LOADING': 'loading', 'LOADED': 'loaded', 'FAILED': 'failed'}
        }
    },
    computed: {
        is_valid_text: function(){
            let tm = this.clearData(this.f_texto);
            if(this.targetItem == null){
                return false;
            }
            return (tm != '' && this.targetItem.texto != tm)? true: false;
        }
    },
    methods: {
        isEmpty: function(arg){
            return (arg == '')? true: false;
        },
        clearData: (arg) => arg.replace(/(^\s+|\s+$)/g, '').replace(/\s{2,}/g, ' '),
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
        openEdit: function(ite){
            this.targetItem = ite;
            console.log(this.targetItem);
            this.num_suma = 0;
            this.num_suma_alt = 0;
            this.num_fields.forEach(fx => {
                if(fx == this.targetItem.field){
                    this.num_suma_alt = parseInt(this.datos[fx]);
                }else{
                    this.num_suma += parseInt(this.datos[fx]);
                }
            });
            this.getCalcPercent();
            $('#edKate').modal('show');
        },
        openEditArea: function(ite){
            this.targetItem = ite;
            this.f_texto = this.targetItem.texto;
            $('#edKati').modal('show');
        },
        getFecha: function(arg){
            return (arg != undefined && arg != null) ? arg.slice(0, 10): "";
        },
        setDisplay: function(arg){
            if(['read', 'edit'].includes(arg)){
                this.lc_display = arg;
                this.css_all.title = (this.lc_display == 'read')? 'bg-success fw-bold text-white font-title': 'bg-primary fw-bold text-white font-title';
            }
        },
        setValueItem: function(val){
            // this.targetItem.valor = val;
            this.num_suma_alt = parseInt(val);
            this.getCalcPercent();
            // this.datos[this.targetItem.field] = val;
        },
        getCalcPercent: function(){
            let parcial = ((this.num_suma + this.num_suma_alt) / (this.num_total * 5)) * 100;
            console.log('Parcial: ' + parcial);
            if(parcial % 1 != 0){
                parcial = parseFloat(parcial.toFixed(2));
            }
            this.result_temp = parcial;
        },
        loadForm: function(){
            this.status = this.state.LOADING;
            this.num_total = 0;
            this.num_fields = [];
            axios.post(this.path, {'response_id': this.response_id}).then(res => {
                this.form = res.data.form;
                if(res.data.response != null){
                    this.response = res.data.response;
                    this.datos['name'] = this.response.name;
                    this.datos['numdoc'] = this.response.numdoc;
                    this.datos['cargo'] = this.response.cargo;
                    this.datos['rol'] = this.response.rol;
                }
                this.items = res.data.items.map(elm => {
                    if(elm.tipo != 'title' && elm.tipo != 'sub'){
                        elm.field = 'key_' + elm.tipo + '_' + elm.id;
                        if(elm.tipo == 'num'){
                            this.num_total++;
                            this.num_fields.push(elm.field);
                        }
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
        saveEdit: function(){
            if(this.targetItem != null && this.targetItem.valor != this.num_suma_alt){
                this.status_edit = this.state.LOADING;
                axios.post(this.mimetic + '/data/edit/num', {'response_id': this.response_id, 'data_id': this.targetItem.data_id, 'valor': this.num_suma_alt, 'resultado': this.result_temp}).then(res => {
                    if(res.data.status == 'success'){
                        this.datos[this.targetItem.field] = this.num_suma_alt;
                        this.response.resultado = this.result_temp;
                    }else{
                        console.log(res.data.status);
                        console.log(res.data.info);
                    }
                    $('#edKate').modal('hide');
                    this.targetItem = null;
                    this.status_edit = this.state.LOADED;
                }).catch(err => {
                    console.log(err);
                    $('#edKate').modal('hide');
                    this.targetItem = null;
                    this.status_edit = this.state.FAILED;
                });
            }
        },
        saveEditText: function(){
            if(this.targetItem != null && this.is_valid_text){
                this.status_edit = this.state.LOADING;
                let txpre = this.clearData(this.f_texto);
                axios.post(this.mimetic + '/data/edit/text', {'data_id': this.targetItem.data_id, 'texto': txpre}).then(res => {
                    if(res.data.status == 'success'){
                        this.datos[this.targetItem.field] = txpre;
                    }else{
                        console.log(res.data.status);
                    }
                    $('#edKati').modal('hide');
                    this.targetItem = null;
                    this.status_edit = this.state.LOADED;
                }).catch(err => {
                    console.log(err);
                    $('#edKati').modal('hide');
                    this.targetItem = null;
                    this.status_edit = this.state.FAILED;
                });
            }
        },
        closePoll: function(){
            this.$emit('closePoll', 'success');
        }
    },
    mounted() {
        this.css_all.title = (this.display == 'read')? 'bg-success fw-bold text-white font-title': 'bg-primary fw-bold text-white font-title';
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
tr.row-sub td {padding-top:1px; padding-bottom: 0px}
tr.row-num:hover {background: #E4EFFF66}
tr.row-num td.cell-rad:hover {background: #FFF3CD}
td.td_are {display:none}
.form-radom  > input {display: none; text-align: center}
.form-radom > input + label, .radom {display:inline-block; border:1px solid #777; border-radius: 50%; width:20px; height:20px; box-sizing: border-box; transition: border .1s; background:#FFF}
.form-radom > input:checked + label, .radom.radom-focus {border:7px solid #008CFF}
.radom:hover + .teke {color:#008CFF}

</style>