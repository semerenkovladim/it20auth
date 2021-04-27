require('./bootstrap');
window.Vue = require('vue').default;

import router from "./router/router";
import store from "./vuex/store";


const app = new Vue({
    el: '#app',
});

app.use(router);
app.use(store);
