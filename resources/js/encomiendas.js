import Vue from 'vue';

Vue.component('v-encomiendas', require('./components/encomiendas.vue').default);

const app = new Vue({
    el: '#encomiendas-page',
});