import Vue from 'vue';

Vue.component('v-buses', require('./components/buses.vue').default);

const app = new Vue({
    el: '#buses-page',
});