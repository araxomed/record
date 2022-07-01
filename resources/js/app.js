require('./bootstrap');

import { createApp } from "vue";
import AlertComponent from "./componentes/alerta.vue";
import Reader from "./componentes/encuesta_reader.vue";
import ReaderPlus from "./componentes/encuesta_reader_plus.vue";
import Pobla from "./componentes/poblacion.vue";
import Tokada from "./componentes/asignados.vue";
import Barra from "./componentes/am_bar.vue";
import Torta from "./componentes/am_pie.vue";
import Braket from "./componentes/am_bar_tech.vue";
import ReadRecord from "./componentes/lector_registros.vue";
import Statics from "./componentes/estadisticas.vue";
import Exdata from "./componentes/excel_data.vue";

createApp({
    components: {
        'encuesta-show': Reader,
        'encuesta-plus': ReaderPlus,
        'comp-poblacion': Pobla,
        'comp-asignados': Tokada,
        'am-bar': Barra,
        'am-bar-tech': Braket,
        'am-pie': Torta,
        'lector-registro': ReadRecord,
        'cmp-estadisticas': Statics,
        'excel-data': Exdata
    }
}).mount("#appRecord");


// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();

// import Vue from 'vue';

// window.Vue = require('vue');
// window.$eventBus = new Vue();

// Vue.component('alerta', require('./componentes/alerta.vue').default);

// window.app = new Vue({el: '#appRecord'});
