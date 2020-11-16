import ExampleComponent from "./components/Login";

require('./bootstrap');

import Vue from 'vue';

import VueRouter from 'vue-router';
import VueResource from 'vue-resource';

import axios from 'axios';
import Index from "./Index";
import moment from 'moment';
import store from './store';
import router from './routes';
import Notifications from "vt-notifications";
import 'vue2-dropzone/dist/vue2Dropzone.min.css';

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(VueResource);
Vue.use(Notifications);

Vue.filter('formatDate',function(value){
   if(value){
       return moment(String(value)).locale('tr').startOf('day').fromNow();
   }
});


const app = new Vue({
    el: '#app',
    router : router,
    components : {
        'index' : Index,
    },
    store
});
