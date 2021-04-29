/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue').default;
import router from "./router/router";
import store from "./vuex/store";
import Vue from 'vue'
import TheLayout from "./components/layouts/TheLayout";

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(TheLayout)
})

