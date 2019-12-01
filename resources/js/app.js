/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import axios from 'axios'
Vue.prototype.$http = axios;

import methods from './mixins/methods'
Vue.mixin(methods);

import Vuesax from 'vuesax'

import 'vuesax/dist/vuesax.css' //Vuesax styles
Vue.use(Vuesax)
import 'material-icons/iconfont/material-icons.css';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/Index.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('index', require('./components/Index.vue').default);
Vue.component('profile', require('./components/Summoner.vue').default);
Vue.component('match-list', require('./components/MatchList.vue').default);
Vue.component('match', require('./components/Match.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
