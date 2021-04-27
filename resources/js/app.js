/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router'
import routes from "./router/routes";
import store from "./vuex/store";
import Vuex from 'vuex'

const router = new VueRouter({
    mode: 'history',
    routes
})

Vue.use(Vuex)

const storage = new Vuex.Store({
    store
})

const app = new Vue({
    el: '#app',
    router,
    storage,
});

