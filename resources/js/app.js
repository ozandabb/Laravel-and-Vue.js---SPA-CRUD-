require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import routes from './routes';
import VueAxios from 'vue-axios';
import axios from 'axios';
import Swal from 'sweetalert2'
import Toaster from 'v-toaster'

import 'v-toaster/dist/v-toaster.css'
import 'sweetalert2/src/sweetalert2.scss'
import { TableComponent, TableColumn } from 'vue-table-component';

window.Swal = Swal;

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Toaster, {timeout: 5000})
Vue.component('table-column', TableColumn);
Vue.component('table-component', TableComponent);
Vue.component('pagination', require('laravel-vue-pagination'));

const router = new VueRouter(routes);

const app = new Vue({
    el: '#app',
    router,
});
