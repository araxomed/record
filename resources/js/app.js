require('./bootstrap');

import Vue from 'vue';

window.Vue = require('vue');
window.$eventBus = new Vue();

Vue.component('mapa', require('./componentes/mapa.vue').default);
Vue.component('listado', require('./componentes/listado.vue').default);
Vue.component('table-data', require('./componentes/table-data.vue').default);
Vue.component('grafico-torta', require('./componentes/chart-pie.vue').default);

window.app = new Vue({
    el: '#mainApp'
});