<template>
    <div>
        <div v-if="status == state.LOADING" class="d-flex align-items-center">
            <i class='bx bx-loader bx-spin fs-3 me-2'></i>
            <p class="my-0">Cargando información...</p>
        </div>
        <div v-else>
            <div v-if="datos.length > 0">
                <div class="table-responsive">
                    <table class="table table-bordered border border-secondary table-sm" id="tsion">
                        <thead>
                            <tr v-if="status_item == state.LOADED">
                                <th class="colmin">
                                    <div class="roty">No.</div>
                                </th>
                                <th v-for="(cab, i) in heads" :key="i"><div class="roty">{{ cab.l }}</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(dato, i) in datos" :key="i">
                                <td class="text-center">{{ i + 1 }}</td>
                                <td v-for="(item, t) in heads" :key="t" :class="item.c">
                                    {{ dato[item.k] }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div :class="status_excel == 'loaded'? 'text-start mt-5': 'd-none'">
                    <a :href="encodeUri" class="btn bg-primary text-white px-5" download="Encuestas.xls">Exportar a Excel</a>
                </div>
            </div>
            <div v-else>
                <div class="alert alert-warning py-2 border-1 border border-warning rounded-3" style="border-left-width:5px !important">
                    <div class="d-flex align-items-center">
                        <i class="bx bx-info-circle fs-1 me-2"></i>
                        <div>No se encontraron encuestas diligencidas.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        mimetic: {type: String, default: ''},
        keydata: {type: String, default: ''},
    },
    data() {
        return {
            lc_key: 0,
            items: [],
            datos: [],
            heads: [],
            tipos: {},
            rawfill: {},
            registros: [],
            status: 'loading',
            status_item: 'ini',
            status_excel: 'ini',
            state: {'INI': 'ini', 'LOADING': 'loading', 'LOADED': 'loaded', 'FAILED': 'failed'},
            dataExport: null,
            filas: [],
            encodeUri: null
        }
    },
    methods: {
        loadItems: function(){
            this.status_item = this.state.LOADING;
            this.tipos = {};
            this.heads = [
                {'k': 'name', 'l': 'Nombres y apellidos', 'c': 'str-are'}, 
                {'k': 'numdoc', 'l': 'Identificación', 'c': 'str-are'}, 
                {'k': 'cargo', 'l': 'Cargo', 'c': 'str-are'}, 
                {'k': 'rol', 'l': 'Rol', 'c': 'str-are'}, 
                {'k': 'mision', 'l': 'Misión', 'c': 'str-are'}
            ];
            axios.post(this.mimetic, {'tabla': 'formularios_items', 'campo1': 'formulario_id', 'valor1': this.lc_key, 'orden': 'orden'}).then(res => {
                this.items = res.data;
                this.items.forEach(elm => {
                    if(elm.tipo == 'num' || elm.tipo == 'are'){
                        this.heads.push({'k': elm.id.toString(), 'l': elm.item, 'c': 'str-' + elm.tipo});
                        this.tipos[elm.id.toString()] = elm.tipo;
                    }
                });
                this.heads.push({'k': 'created_at', 'l': 'Fecha de registro', 'c': 'str-are'});
                this.status_item = this.state.LOADED;
                this.loadData();
            }).catch(err => {
                console.log(err);
                this.status_item = this.state.FAILED;
            });
        },
        loadData: function(){
            this.status = this.state.LOADING;
            axios.post(this.mimetic, {
                'tabla': 'formularios_response', 
                'join': 'formularios_data:formularios_response.id:formularios_data.response_id', 
                'campo1': 'formularios_response.formulario_id',
                'valor1': this.lc_key,
                'campos': 'formularios_response.name,formularios_response.numdoc,formularios_response.cargo,formularios_response.rol,formularios_response.mision,formularios_response.created_at,formularios_data.id,formularios_data.texto,formularios_data.valor,formularios_data.response_id,formularios_data.item_id',
                'orden': 'formularios_response.id|formularios_data.item_id'
            }).then(res => {
                res.data.forEach(elm => {
                    if(this.rawfill[elm.response_id] == undefined){
                        this.rawfill[elm.response_id] = this.makeRow(elm);
                    }
                    this.rawfill[elm.response_id][elm.item_id] = (this.tipos[elm.item_id] == 'num')? elm.valor: elm.texto; 
                });
                this.datos = Object.values(this.rawfill);
                this.status = this.state.LOADED;
                this.toExcel();
            }).catch(err => {
                console.log(err);
                this.status = this.state.FAILED;
            });
        },
        makeRow: function(arr){
            let rs = {};
            this.heads.forEach(elm => rs[elm.k] = '');
            ['name', 'numdoc', 'cargo', 'rol', 'mision', 'created_at'].forEach(elm => rs[elm] = arr[elm]);
            return rs;
        },
        setFormId: function(ik){
            this.lc_key = parseInt(ik);
            this.loadItems();
        },
        exportToExcel: function(){
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById('tsion');
            console.log(tableSelect);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            this.dataExport = 'data:' + dataType + ', ' + tableHTML;
        },
        toExcel: function(){
            this.filas = [];
            let hds = ['No.'];
            this.heads.forEach(elm => {
                hds.push(elm.l);
            });
            this.filas.push(hds);
            this.datos.forEach((dato, i) => {
                let rew = [i + 1];
                this.heads.forEach((item, t) => {
                    rew.push(dato[item.k]);
                });
                this.filas.push(rew);
            });
            let csvContent = "data:text/csv;charset=utf-8,";
            this.filas.forEach(tar => {
                let tmp = tar.join("\t");
                csvContent += tmp + "\r\n";
            });
            this.encodeUri = encodeURI(csvContent);
            // link.setAttribute("download", "Tabla_de_datos.csv");
            this.status_excel = 'loaded';
        }
    },
    mounted() {
        if(this.keydata != ''){
            this.setFormId(this.keydata);
        }
    }
}
</script>
<style scoped>
.colmin {width: 1%; white-space: nowrap; text-align: center}
.roty {writing-mode: vertical-rl; transform: rotate(180deg); position:relative; max-height: 200px; white-space: normal !important}
.str-num {text-align: center}
</style>