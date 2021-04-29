import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import UsersManagementPage from "../components/views/UsersManagementPage";
import PersonalDataPage from "../components/views/PersonalDataPage";

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/users-management',
            component: UsersManagementPage
        },
        {
            path: '/personal-data',
            component: PersonalDataPage
        }
    ]
})

export default router;
