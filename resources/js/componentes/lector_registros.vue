<template>
    <div>
        <div :class="mode == 'record'? 'card radius-10 w-100': 'd-none'">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-0">{{ pollname }}</h5>
                        <div class="text-secondary font-13">Encuestas diligenciadas</div>
                    </div>
                    <div class="font-22">
                        <i class='bx bx-dots-horizontal'></i>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-5">
                    <div class="form-floating flex-fill me-2">
                        <input type="text" class="form-control" id="tz-1" autocomplete="off" v-model="f_numdoc">
                        <label for="tz-1">Número de identificación:</label>
                    </div>
                    <div class="form-floating flex-fill mx-2">
                        <input type="text" class="form-control" id="tz-2" autocomplete="off" v-model="f_name">
                        <label for="tz-2">Nombre del encuestado:</label>
                    </div>
                    <div class="form-floating flex-fill mx-2">
                        <input type="text" class="form-control" id="tz-3" autocomplete="off" v-model="f_cargo">
                        <label for="tz-3">Cargo del encuestado:</label>
                    </div>
                    <button class="btn btn-primary flex-fill ms-2" v-on:click="loadData"><i class="bx bx-search"></i> Buscar</button>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th class="colmin px-2">No.</th>
                                <th>Identificación</th>
                                <th>Nombres y apellidos</th>
                                <th>Cargo</th>
                                <th>Rol</th>
                                <th>Encuesta</th>
                                <th class="text-center">Puntaje</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th class="colmin">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(elm, i) in registros" :key="i">
                                <td class="text-center">{{ i + 1 }}</td>
                                <td>{{ elm.numdoc }}</td>
                                <td>{{ elm.name }}</td>
                                <td>{{ elm.cargo }}</td>
                                <td>{{ elm.rol }}</td>
                                <td>{{ elm.formulario }}</td>
                                <td class="text-center"><div :class="getPercentClass(elm.resultado)">{{ elm.resultado }}%</div></td>
                                <td>{{ getFecha(elm.created_at) }}</td>
                                <td>{{ getHora(elm.created_at) }}</td>
                                <td>
                                    <div class="d-flex order-actions justify-content-center">
                                        <a class="btn-hover" href="#" title="Encuesta" v-on:click="openPoll(elm.id)"><i class='bx bx-right-arrow-circle'></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div :class="mode == 'poll'? 'card radius-10 w-100': 'd-none'">
            <div class="card-body">
                <lc-reader ref="viewpoll" @close-poll="listen" :path="pathpoll"></lc-reader>
            </div>
        </div>
    </div>
</template>
<script>
import Plus from "./encuesta_reader_plus.vue";
export default {
    components: {
        'lc-reader': Plus
    },
    props: {
        mimetic: {type: String, default: ''},
        keydata: {type: String, default: ''},
        pollname: {type: String, default: ''},
        pathpoll: {type: String, default: ''}
    },
    data() {
        return  {
            mode: 'record',     // record | poll
            registros: [],
            f_numdoc: '',
            f_name: '',
            f_cargo: '',
            status: 'ini',
            state: {'INI': 'ini', 'LOADING': 'loading', 'LOADED': 'loaded', 'FAILED': 'failed'}
        }
    },
    methods: {
        getPercentClass: function(num){
            if(num >= 90){
                return 'badge rounded-pill bg-success w-100';
            }else{
                return (num >= 80)? 'badge rounded-pill bg-warning w-100': 'badge rounded-pill bg-danger w-100';
            }
        },
        loadData: function(){
            var campos = "formularios_response.id,formularios_response.name,formularios_response.numdoc,formularios_response.cargo,formularios_response.resultado,formularios_response.rol,formularios_response.created_at,formularios.formulario";
            var pam = {
                'tabla': 'formularios_response', 
                'join': 'formularios:formularios_response.formulario_id:formularios.id', 
                'campos': campos,
                'campo1': 'formularios_response.formulario_id',
                'valor1': this.keydata
            };
            var numdoc = this.sinespace(this.f_numdoc);
            if(numdoc != ''){
                pam['campo2'] = 'formularios_response.numdoc';
                pam['valor2'] = numdoc;
            }
            var name = this.clearData(this.f_name);
            if(name != ''){
                pam['campo3'] = 'formularios_response.name';
                pam['valor3'] = '%' + name + '%';
                pam['operador3'] = 'like';
            }
            var cargo = this.clearData(this.f_cargo);
            if(cargo != ''){
                pam['campo4'] = 'formularios_response.cargo';
                pam['valor4'] = '%' + cargo + '%';
                pam['operador4'] = 'like';
            }
            axios.post(this.mimetic, pam).then(res => {
                console.log('data len');
                console.log(res.data);
                this.registros = res.data;
            }).catch(err => {
                console.log('Error catch!');
                console.log(err);
            });
        },
        clearData: function(arg){
            return arg.replace(/\s{2,}/g, ' ').replace(/(^\s+|\+$)/g, '');
        },
        sinespace: function(arg){
            return arg.replace(/\s+/g, '');
        },
        getFecha: function(arg){
            return arg.slice(0, 10);
        },
        getHora: function(arg){
            try {
                var tm = arg.slice(-8).split(':');
                var h = parseInt(tm[0]);
                if(h > 12){
                    return (h - 12) + ':' + tm[1] + ' pm';
                }
                return h + ':' + tm[1] + ' am';
            } catch {
                return "";
            }
        },
        openPoll: function(idpoll){
            this.mode = 'poll';
            this.$refs.viewpoll.setResponseId(idpoll);
        },
        listen: function(arg){
            this.mode = 'record';
        }
    },
    mounted() {
        this.loadData();
    }
}
</script>
<style scoped>
.colmin {width:1%; white-space: nowrap; text-align: center}
</style>