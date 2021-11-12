<template>
    <div :class="is_show? '': 'd-none'" style="overflow-y:auto !important; height:100vh">
        <table class="table table-stripe">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Job and Description</th>
                    <th>Assigned to</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, i) in registros" :key="i">
                    <td>{{ (i + 1) + ((pagina - 1) * per_page) }}</td>
                    <td>
                        <div class="d-flex">
                            <img :src="item.image" alt="Imagen" class="img-thumbnail me-3" width="160">
                            <div>
                                <h5>{{ item.title }}</h5>
                                <p>{{ item.description }}</p>
                            </div>
                        </div>
                    </td>
                    <td>{{ item.assigned_to }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>{{ item.updated_at }}</td>
                    <td class="text-center">
                        <span :class="statusClass(item.status)">{{ item.status }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    props: {
        ocultar: {type: Boolean, default: false},
    },
    data(){
        return {
            registros: [],
            pagina: 1,
            per_page: 15,
            is_show: true,
        }
    },
    methods: {
        setVisible: function(bool){
            this.is_show = bool;
        },
        statusClass: function(stt){
            if(stt == 'pending'){
                return "badge bg-danger rounded-pill text-white py-2 px-3";
            }else if(stt == 'complete'){
                return "badge bg-success rounded-pill text-white py-2 px-3";
            }else{
                return "badge bg-warning rounded-pill text-dark py-2 px-3";
            }
        },
        setDatos: function(arg){
            this.registros = arg;
        },
        setPagina: function(num){
            this.pagina = num;
        },
        listen: function(){
            $eventBus.$on('view-mode', mode => this.setVisible(mode == 'table'));
            $eventBus.$on('change-page', arg => {
                this.pagina = arg.pagina,
                this.registros = arg.registros;
            });
        }
    },
    mounted(){
        this.is_show = !this.ocultar;
        this.listen();
    }
}
</script>
