import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import UsersManagementPage from "../components/UsersManagement/views/UsersManagementPage";

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/users-management',
            component: UsersManagementPage
        }
    ]
})

export default router;
