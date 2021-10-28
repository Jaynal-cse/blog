


require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';

Vue.use(VueRouter)


import {routes} from './routes';
Vue.component('example-component', require('./components/ExampleComponent.vue'));


const router = new VueRouter({
    routes,
    mode:'history' // short for `routes: routes`
  })

const app = new Vue({
    el: '#app',
    routes 

});
