/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue').default;
<<<<<<< HEAD
import router from "./router/router";
import store from "./vuex/store";
import Vuex from 'vuex'
import TheLayout from './components/TheLayout'
=======
import Vue from 'vue'
//
// import Vuex from "vuex";
//
// Vue.use(Vuex)
import router from "./router/router";
import store from "./vuex/store";
import TheLayout from "./components/TheLayout";
>>>>>>> 876872aa19569a91030d2b8fe5d3681f6454b5be


// Vue.use(Vuex)
//
// const storage = new Vuex.Store({
//     store
// })

const app = new Vue({
    el: '#app',
    router,
<<<<<<< HEAD
    storage,
    render: h => h(TheLayout)
});
=======
    store,
    render: h => h(TheLayout)
})

>>>>>>> 876872aa19569a91030d2b8fe5d3681f6454b5be

