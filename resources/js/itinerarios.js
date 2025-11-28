import Vue from 'vue';

Vue.component('v-itinerarios', require('./components/itinerarios.vue').default);

const app = new Vue({
    el: '#itinerarios-page',
});