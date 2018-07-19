
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import BootstrapVue from 'bootstrap-vue'
import Vue from 'vue'
import VueRouter from 'vue-router';
import { routes } from './routes';
Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.component('pagenotfound', require('./components/PageNotFound.vue'));
const router = new VueRouter({
    mode: 'history',
    routes
});
new Vue({
    el: '#app',
    router
});