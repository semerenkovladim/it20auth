/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue'
//
// import Vuex from "vuex";
//
// Vue.use(Vuex)
import router from "./router/router";
import store from "./vuex/store";
import TheLayout from "./components/TheLayout";


// Vue.use(Vuex)
//
// const storage = new Vuex.Store({
//     store
// })

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(TheLayout)
})


