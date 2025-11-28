import Vue from 'vue';

Vue.component('v-ventas', require('./components/ventas.vue').default);

const app = new Vue({
    el: '#ventas-page',
});