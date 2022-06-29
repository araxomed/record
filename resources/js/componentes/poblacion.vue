<template>
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group mb-4">
                <button type="button" :class="(display == 'data')? 'btn bg-primary bg-gradient text-white': 'btn btn-outline-primary bg-light-primary'" v-on:click="display = 'data'"><i class="bx bx-data"></i> Población</button>
                <button type="button" :class="(display == 'write') ? 'btn bg-primary bg-gradient text-white': 'btn btn-outline-primary bg-light-primary'" v-on:click="display = 'write'"><i class="bx bx-save"></i> Registro</button>
            </div>
            <div class="fs-5x">
                <span class="text-secondary me-2">Población total:</span>
                <span style="color:#000; letter-spacing: 1px; font-weight:bold">{{ registros.length }}</span>
            </div>
        </div>
        <div v-if="display == 'data'">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="d-flex">
                        <div class="form-floating me-3">
                            <select class="form-select" id="cm-1" aria-label="Floating label select example" v-model="area">
                                <option v-for="(are, i) in areas" :key="i" :value="are">{{ are.label }}</option>
                            </select>
                            <label for="cm-1">Seleccione el área</label>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" id="cm-1" aria-label="Floating label select example" v-model="targetEval">
                                <option value=""></option>
                                <option v-for="(eva, i) in evaluadores" :key="i" :value="eva">{{ eva }}</option>
                            </select>
                            <label for="cm-1">Seleccione el evaluador</label>
                        </div>
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="xwk-1" v-model="enable_rem">
                    <label class="form-check-label" for="xwk-1">Habilitar eliminación</label>
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
                            <th class="colmin">Diligenciada</th>
                            <th class="colmin text-center" v-if="enable_rem">Acción</th>
                        </tr>
                    </thead>
                    <tbody v-if="enable_rem == false">
                        <tr v-for="(elm, i) in getRegistros()" :key="i">
                            <td class="text-center">{{ i + 1 }}</td>
                            <td class="px-4">{{ elm.numdoc }}</td>
                            <td>{{ elm.name }}</td>
                            <td :class="targetArea == 'all'? '': 'bg-light-warning border border-warning'">{{ elm.area }}</td>
                            <td>{{ elm.evaluador }}</td>
                            <td>{{ elm.formulario }}</td>
                            <td class="text-center"><span :class="elm.lc_total > 0? 'badge bg-success rounded-pill': 'badge bg-danger rounded-pill'">{{ elm.lc_total }}</span></td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr v-for="(elm, i) in getRegistros()" :key="i">
                            <td class="text-center">{{ i + 1 }}</td>
                            <td class="px-4">{{ elm.numdoc }}</td>
                            <td>{{ elm.name }}</td>
                            <td :class="targetArea == 'all'? '': 'bg-light-warning border border-warning'">{{ elm.area }}</td>
                            <td>{{ elm.evaluador }}</td>
                            <td>{{ elm.formulario }}</td>
                            <td class="text-center"><span :class="elm.lc_total > 0? 'badge bg-success rounded-pill': 'badge bg-danger rounded-pill'">{{ elm.lc_total }}</span></td>
                            <td>
                                <div class="d-flex justify-content-center order-actions">
                                    <a href="javascript:void(0)" :class="elm.lc_total == 0? 'fx-border-hover border': 'fx-border-hover border text-none pe-none'" :disabled="elm.lc_total == 0" title="Eliminar" v-on:click="removePeople(elm.numdoc, elm.lc_total)"><i class="bx bx-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div v-else-if="display == 'write'">
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="x-2" style="min-height: 500px" v-model="raw_excel"></textarea>
                        <label for="x-2" class="text-primary">Pegue aquí el listado de personas:</label>
                    </div>
                </div>
                <div class="col-sm-7">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Identificación</th>
                                <th>Nombres y apellidos</th>
                                <th>Encuesta</th>
                                <th>Área</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="boxdata.length == 0">
                                <td colspan="3">
                                    <div class="alert border border-warning my-2 py-2 bg-light-warning" style="border-left-width:5px !important">
                                        <div class="d-flex align-items-center">
                                            <i class="bx bx-info-circle fs-1 me-2 text-warning"></i>
                                            <div class="text-primaryx">Pegue el listado de usuarios o población objetivo para realizar las encuestas. Elabore en Excel el listado de la población con tres columnas (cédula, nombre completo, encuesta aplicable y área: la columna área es opcional), luego seleccione el contenido, copie y pegue en el área de texto ubicada a la izquierda de este mensaje.</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr v-for="(elm, i) in boxdata" :key="i">
                                <td>{{ elm.numdoc }}</td>
                                <td>{{ elm.name }}</td>
                                <td>{{ elm.form_id }}</td>
                                <td>{{ elm.area }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3"><button class="btn btn-primary py-2 px-4" type="button" style="font:12px Arial; letter-spacing:1px" v-on:click="addPeople" :disabled="boxdata.length == 0">GUARDAR POBLACIÓN</button></th>
                            </tr>
                        </tfoot>
                    </table>
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
        rempath: {type: String, default: ''},
    },
    data() {
        return {
            display: 'data',        // data | write
            enable_rem: false,
            forms: [],
            dictForm: {},
            registros: [],
            areas: [],
            evaluadores: [],
            area: {'label': '', 'value': 'all'},
            targetArea: 'all',
            targetEval: '',
            raw_excel: '',
            boxdata: [],
            status: 'ini',
            status_add: 'ini',
            state: {'INI': 'ini', 'LOADING': 'loading', 'LOADED': 'loaded', 'FAILED': 'failed'}
        }
    },
    watch: {
        raw_excel: function(val){
            this.processData();
        },
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
            if(this.targetArea == 'all'){
                return (this.targetEval == '')? this.registros: this.registros.filter(elm => elm.evaluador == this.targetEval);
            }else{
                return (this.targetEval == '')? this.registros.filter(elm => elm.area == this.targetArea): this.registros.filter(elm => elm.area == this.targetArea && elm.evaluador == this.targetEval);
            }
        },
        loadPeople: function(){
            this.status = this.state.LOADING;
            let campos = "poblacion.id, poblacion.numdoc, poblacion.name, poblacion.area, poblacion.evaluador, formularios.formulario";
            axios.post(this.mimetic, {'tabla': 'poblacion', 'join': 'formularios:poblacion.formulario_id:formularios.id:left|formularios_response:poblacion.numdoc:formularios_response.numdoc:left', 'agrupar': 'poblacion.numdoc:formularios_response.id', 'campos': campos}).then(res => {
                this.registros = res.data;
                let tmp = {};
                let eva = {};
                res.data.forEach(elm => {
                    if(this.is_empty(elm.area)){
                        tmp['-void-'] = '';
                    }else{
                        tmp[elm.area] = '';
                    }
                    if(elm.evaluador != null) eva[elm.evaluador] = '';
                });
                this.areas = Object.keys(tmp).map(elm => elm == '-void-'? ({'label': 'Sin área asignada', 'value': null}): ({'label': elm, 'value': elm})).sort((a, b) => b.label - a.label);
                this.areas.unshift({'label': '', 'value': 'all'});
                this.evaluadores = Object.keys(eva);
                this.status = this.state.LOADED;
            }).catch(err => {
                console.log(err);
                this.status = this.state.FAILED;
            });
        },
        processData: function(){
            this.boxdata = [];
            let lineas = this.raw_excel.split("\n");
            lineas.forEach(linea => {
                var slin = String(linea);
                if(slin != ''){
                    let campos = slin.split("\t");
                    if(campos.length >= 2){
                        var cc = this.nospace(campos[0]);
                        var nom = this.clearData(campos[1]);
                        var mnu = (campos.length >= 3)? this.getFormId(this.clearData(campos[2])): null;
                        var form_id = mnu;
                        var tm = (campos.length >= 4)? this.clearData(campos[3]): null;
                        var are = this.is_empty(tm)? null: tm;
                        this.boxdata.push({'numdoc': cc, 'name': nom, 'form_id': form_id, 'area': are});
                    }
                }
            });
        },
        addPeople: function(){
            if(this.boxdata.length > 0){
                var pam = new FormData();
                pam.append('people', JSON.stringify(this.boxdata));
                this.status_add = this.state.LOADING;
                axios.post(this.path, pam).then(res => {
                    this.loadPeople();
                    this.status_add = this.state.LOADED;
                    this.boxdata = [];
                    this.raw_excel = '';
                    this.display = 'data';
                }).catch(err => {
                    console.log(err);
                    this.status_add = this.state.FAILED;
                });
            }
        },
        removePeople: function(cc, npol){
            if(npol == 0){
                axios.post(this.rempath, {'numdoc': cc}).then(res => {
                    if(res.data.status == 'success'){
                        for(var i = 0; i < this.registros.length; i++){
                            if(this.registros[i].numdoc == cc){
                                this.registros.splice(i, 1);
                                break;
                            }
                        }
                    }
                }).catch(err => {
                    console.log(err);
                })
            }else{alert('no se puede')}
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
</style>