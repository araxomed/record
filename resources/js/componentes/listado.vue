<template>
    <div>
        <div class="pyw-3" style="border-bottom:1px solid #FFFFFF22; background:#3F4246">
            <div class="d-flex justify-content-evenlyx">
                <div :class="getClassView('map')" v-on:click="setViewMode('map')">
                    <i class="bi bi-geo-alt-fill fs-2"></i>
                    <div>Mapa</div>
                </div>
                <div :class="getClassView('table')" v-on:click="setViewMode('table')">
                    <i class="bi bi-table fs-2"></i>
                    <div>Tabla</div>
                </div>
                <div :class="getClassView('chart')" v-on:click="setViewMode('chart')">
                    <i class="bi bi-pie-chart-fill fs-2"></i>
                    <div>Gráfico</div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div :class="(targetIndex == i)? 'px-3 py-1 is-active bg-warning': 'px-3 py-1 entrada'" v-for="(reg, i) in registros" :key="i" v-on:click="selectItem(reg, i)" @mouseover="evtHover(i)">
                <i class="bi bi-geo-alt-fill me-2"></i>
                <span style="font-size:.85rem">{{ reg.assigned_to }}</span>
            </div>
        </div>
        <div class="d-flex justify-content-between mx-3">
            <div class="btn-group">
                <button type="button" v-on:click="loadData(1)" class="btn btn-outline-secondary"><i class="bi bi-chevron-bar-left"></i></button>
                <button type="button" v-on:click="loadData(Math.max(1, current_page - 1))" class="btn btn-outline-secondary"><i class="bi bi-chevron-left"></i></button>
            </div>
            <button class="btn btn-light btn-smx" disabled>Página {{ current_page }}</button>
            <div class="btn-group">
                <button type="button" v-on:click="loadData(Math.min(num_pages, current_page + 1))" class="btn btn-outline-secondary"><i class="bi bi-chevron-right"></i></button>
                <button type="button" v-on:click="loadData(num_pages)" class="btn btn-outline-secondary"><i class="bi bi-chevron-bar-right"></i></button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        ruta: {type: String, default: 'none'}
    },
    data() {
        return {
            links: [],
            registros: [],
            num_pages: -1,
            targetIndex: -1,
            current_page: 1,
            view_mode: 'map',   // map | table | chart
        }
    },
    methods: {
        loadData: function(pag){
            if(this.ruta != 'none'){
                axios.get(this.ruta + '?pagina=' + pag).then(res => {
                    this.num_pages = res.data.last_page;
                    this.current_page = res.data.current_page;
                    this.links = res.data.links;
                    this.registros = res.data.data;
                    $eventBus.$emit('load-jobs', this.registros.map(elm => {
                        return {'title': elm.title, 'lat': parseFloat(elm.latitude), 'lng': parseFloat(elm.longitude), 'label': elm.assigned_to, 'info': this.writeInfo(elm)}
                    }));
                    $eventBus.$emit('change-page', {'pagina': this.current_page, 'registros': res.data.data});
                }).catch(err => {console.log(err)});
            }
        },
        getClassView: function(arg){
            return (this.view_mode == arg)? 'fill-button flex-fill bg-success text-white': 'fill-button flex-fill';
        },
        setViewMode: function(arg){
            this.view_mode = arg;
            $eventBus.$emit('view-mode', arg);
        },
        selectItem: function(elm, index){
            if(this.targetIndex == index){
                this.targetIndex = -1;
                $eventBus.$emit('unselect-job', {'title': elm.title, 'lat': parseFloat(elm.latitude), 'lng': parseFloat(elm.longitude), 'label': elm.assigned_to});
            }else{
                this.targetIndex = index;
                $eventBus.$emit('select-job', {'title': elm.title, 'lat': parseFloat(elm.latitude), 'lng': parseFloat(elm.longitude), 'label': elm.assigned_to, 'info': this.writeInfo(elm)});
            }
        },
        writeInfo: function(elm){
            var winbody = "<div>" + 
                                "<h1>" + elm.title + "</h1>" + 
                                "<div class='border-top pt-3'>" +
                                    "<div class='d-flex mb-3'>" +
                                        "<div class='me-3'><img src='" + elm.image + "' alt='Imagen' width='240'></div>" +
                                        "<div>" +
                                            "<div class='d-flex justify-content-between mb-3'>" +
                                                "<div><small>Assigned to:</small><br><b class='text-success fs-6'>" + elm.assigned_to + "</b></div>" +
                                                "<div><small>Status:</small><br><b class='text-success fs-6'>" + elm.status + "</b></div>" +
                                            "</div>" +
                                            "<p class='fs-6'>" + elm.description + "</p>" +
                                            "<div class='d-flex justify-content-between'>" +
                                                "<div><small>Created:</small><br><b class='text-dark'>" + elm.created_at.slice(0, 10) + "</b></div>" +
                                                "<div><small>Updated:</small><br><b class='text-dark'>" + elm.updated_at.slice(0, 10) + "</b></div>" +
                                            "</div>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>" + 
                            "</div>";
            return winbody;
        },
        evtHover: function(arg){
            if(this.targetIndex == -1){
                $eventBus.$emit('over-job', arg);
            }
        }
    },
    mounted() {
        this.loadData(1);
    }
}
</script>
<style scoped>
    .entrada {border-bottom:1px solid #FFFFFF12; color:#FFFFFF77; cursor: default}
    .entrada:hover {background:#FFF3CD; color:#444}
    .is-active {border-bottom:1px solid #FFFFFF12}
    .fill-button {padding-top:1rem; padding-bottom:1rem; text-align: center !important; color: #FFFFFF77; cursor: pointer}
    .fill-button:hover {color: #FFFFFF77; background: #FFFFFF22}
    .fill-button + .fill-button {border-left:1px solid #FFFFFF33}
</style>