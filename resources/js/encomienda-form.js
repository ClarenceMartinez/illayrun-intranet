import Vue from 'vue';
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);
Vue.component('v-encomienda-form', require('./components/encomienda-form.vue').default);
const app = new Vue({
    el: '#encomienda-form-page',
});