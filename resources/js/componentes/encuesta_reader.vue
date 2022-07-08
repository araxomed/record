<template>
    <div :class="(display == 'read' || display == 'preview')? 'pe-none': ''">
        <div class="d-flex align-items-center justify-content-between border-bottom mb-4 pb-2">
            <div v-if="form != null">
                <h5 class="mb-0 text-uppercase">{{ form.formulario }}</h5>
                <div class="text-secondary font-13">Encuesta del área de {{ form.area }}</div>
            </div>
            <div class="font-22">
                <i class="bx bx-chevron-up-circle d-print-none"></i>
            </div>
        </div>
        <div class="row mb-3" v-if="display == 'read' && response != null">
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
        <div class="row mb-3">
            <div class="col-sm-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="tx-0" autocomplete="off" v-model="datos['name']" :readonly="employee != '' && display == 'write'">
                    <label for="tx-0">Empleado:</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="tx-1" autocomplete="off" v-model="datos['numdoc']" :readonly="cedula != '' && display == 'write'">
                    <label for="tx-1">Identificación:</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="tx-2" autocomplete="off" v-model="datos['cargo']" :readonly="mastercargo != '' && display == 'write'">
                    <label for="tx-2">Cargo:</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="tx-3" autocomplete="off" v-model="datos['rol']" :readonly="masterrol != '' && display == 'write'">
                    <label for="tx-3">Rol ocupacional:</label>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
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
            <tfoot v-if="display == 'write'">
                <tr>
                    <th colspan="6" class="border border-secondary">
                        <div class="d-flex justify-content-center">
                            <div>
                                <div class="fs-2 fw-light mx-5 mb-0" style="line-height:2rem">{{ lc_total - lc_pending }} de {{ lc_total }}</div>
                                <div class="fw-light text-center mb-2" style="font-size:.75rem; letter-spacing:2px">Preguntas resueltas</div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" :style="{'width': getAvance()}" aria-valuemin="0" aria-valuemax="100">{{ getAvance() }}</div>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            </tfoot>
        </table>
        <div class="d-flex justify-content-center mb-4 mt-5" v-if="display == 'write'">
            <button type="button" class="btn btn-primary bg-gradient px-4 py-3" v-on:click="savePoll" :disabled="getStatusWrite() > 0">
                <i class="bx bx-save fs-3"></i>
                <div style="font-size:.75rem; letter-spacing:2px">Guardar encuesta</div>
            </button>
        </div>
        <div class="d-flex justify-content-center mb-4 mt-5" v-if="display == 'read' && response != null">
            <div :class="'card mb-3 text-center ' + getPercentBorder(response.resultado)" style="max-width: 18rem;">
                <div :class="'card-header fw-bold ' + getPercentClass(response.resultado)">{{ getPercentStatus(response.resultado) }}</div>
                <div class="card-body">
                    <p class="mb-0">Resultado de la encuesta</p>
                    <h3 class="mb-0 fs-1">{{ response.resultado }}%</h3>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        path: {type: String, default: ''},
        pathwrite: {type: String, default: ''},
        pathpanel: {type: String, default: ''},
        keydata: {type: String, default: ''},
        employee: {type: String, default: ''},
        cedula: {type: String, default: ''},
        mastercargo: {type: String, default: ''},
        masterrol: {type: String, default: ''},
        display: {type: String, default: 'write'}   // write | read | preview
    },
    data() {
        return {
            css_all: {'title': 'bg-success fw-bold text-white font-title', 'sub': 'bg-custom fw-bold row-sub', 'num': 'row-num', 'are': ''},
            form: null,
            response: null,
            items: [],
            datos: {'formulario_id': '', 'name': '', 'numdoc': '', 'cargo': '', 'rol': ''},  // Fill dinamically...
            num_total: 0,
            num_suma: 0,
            num_fields: [],
            specials: ['name', 'numdoc', 'cargo', 'rol'],
            lc_total: 0,
            lc_pending: 0,
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
        clearData: function(arg){
            return arg.replace(/\s{2,}/g, ' ').replace(/(^\s+|\s+$)/g, '');
        },
        getStatusWrite: function(){
            var pendientes = Object.keys(this.datos).reduce((acum, elm) => acum = (this.datos[elm] == '')? acum + 1: acum, 0);
            this.lc_pending = pendientes;
            return pendientes;
        },
        getFecha: function(arg){
            return (arg != undefined && arg != null) ? arg.slice(0, 10): "";
        },
        getAvance: function(){
            var av = ((this.lc_total - this.lc_pending) / this.lc_total) * 100;
            return (av % 1 == 0)? av + '%': av.toFixed(1) + '%';
        },
        loadForm: function(){
            this.status = this.state.LOADING;
            var pam = (this.display == 'write' || this.display == 'preview')? {'id': this.keydata}: {'response_id': this.keydata};
            axios.post(this.path, pam).then(res => {
                this.form = res.data.form;
                this.num_total = 0;
                if(this.display == 'write' || this.display == 'preview'){
                    this.specials =['name', 'numdoc', 'cargo', 'rol'];
                    this.items = res.data.items.map(elm => {
                        if(elm.tipo != 'title' && elm.tipo != 'sub'){
                            elm.field = 'key_' + elm.tipo + '_' + elm.id;
                            this.datos[elm.field] = '';
                            this.summary.total++;
                            if(elm.tipo == 'num'){
                                this.num_total++;
                                this.num_fields.push(elm.field);
                            }
                            if(elm.tipo == 'are'){
                                this.specials.push(elm.field);
                            }
                        }
                        return elm;
                    });
                    if(this.display == 'write'){
                        this.lc_total = Object.keys(this.datos).length - 1;
                    }
                }else{
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
                            if(elm.data_id != null){
                                this.datos[elm.field] = (elm.tipo == 'num')? elm.valor: elm.texto;
                            }else{
                                this.datos[elm.field] = '';
                            }
                        }
                        return elm;
                    });
                }
                this.status = this.state.LOADED;
            }).catch(err => {
                console.log(err);
                this.status = this.state.FAILED;
            })
        },
        savePoll: function(){
            if(this.display == 'write'){
                this.specials.forEach(elm => this.datos[elm] = this.clearData(this.datos[elm]));
                var pendientes = Object.keys(this.datos).reduce((acum, elm) => acum = (this.datos[elm] == '')? acum + 1: acum, 0);
                if(pendientes == 0){
                    let num_tmp = this.num_total * 5;
                    this.num_suma = 0;
                    this.num_fields.forEach(fx => {
                        this.num_suma += parseInt(this.datos[fx]);
                    });
                    let parcial = (this.num_suma / num_tmp) * 100;
                    if(parcial % 1 != 0){
                        parcial = parseFloat(parcial.toFixed(2));
                    }
                    this.datos['resultado'] = parcial;
                    axios.post(this.pathwrite, this.datos).then(res => {
                        console.log('Ready save:');
                        console.log(res.data);
                        location.href = this.pathpanel;
                    }).catch(err => {
                        console.log(err);
                    });
                }
            }
        },
    },
    mounted() {
        if(this.display == 'write'){
            this.datos['formulario_id'] = this.keydata;
            this.datos['name'] = this.employee;
            this.datos['numdoc'] = this.cedula;
            this.datos['cargo'] = this.mastercargo;
            this.datos['rol'] = this.masterrol;
            this.css_all.title = 'bg-primary fw-bold text-white font-title';
        }else if(this.display == 'preview'){
            this.css_all.title = 'bg-primary fw-bold text-white font-title';
        }
        this.loadForm();
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