
require('./bootstrap');


window.Vue = require('vue');
//import Editor
import VueMarkdownEditor from '@kangc/v-md-editor';
import '@kangc/v-md-editor/lib/style/base-editor.css';
import vuepressTheme from '@kangc/v-md-editor/lib/theme/vuepress.js';
VueMarkdownEditor.use(vuepressTheme);
Vue.use(VueMarkdownEditor);





//import filter
import {filter} from './filter'
//import vuex
import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from './store/index';
const store = new Vuex.Store(
  storeData
)



import VueRouter from 'vue-router';

Vue.use(VueRouter)


import {routes} from './routes';
//Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('admin-main', require('./components/admin/adminMaster.vue'));
Vue.component('home-main', require('./components/public/publicMaster.vue'));

//V Form
import Form from 'vform';
window.Form  = Form;

// ES6 Modules or TypeScript for SweetAlert
import Swal from 'sweetalert2'
import Vue from 'vue';
window.Swal =Swal


const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})



window.Toast = Toast
const router = new VueRouter({
    routes,
    mode:'hash' // short for `routes: routes`
  })

const app = new Vue({
    el: '#app',
    router ,
    store

});
