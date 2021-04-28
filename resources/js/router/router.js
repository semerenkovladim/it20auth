import Vue from 'vue';
import VueRouter from 'vue-router';
import TheLogin from "../components/pages/auth/TheLogin";
import TheAuth from "../components/layouts/TheAuth";
import TheRepairPassword from "../components/pages/auth/TheRepairPassword";
import TheRepairPasswordCode from "../components/pages/auth/TheRepairPasswordCode";
import TheRepairPasswordNew from "../components/pages/auth/TheRepairPasswordNew";

Vue.use(VueRouter);

import UsersManagementPage from "../components/UsersManagement/views/UsersManagementPage";

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/login',
            name: 'login.base',
            component: TheAuth,
            children: [
                {
                    path: '/',
                    name: 'login.index',
                    component: TheLogin
                },
                {
                    path: 'repair-password',
                    name: 'login.repair',
                    component: TheRepairPassword
                },
                {
                    path: 'repair-password/code',
                    name: 'login.repair.code',
                    component: TheRepairPasswordCode
                },
                {
                    path: 'repair-password/new-password',
                    name: 'login.repair.new',
                    component: TheRepairPasswordNew
                }
            ]
        },
        {
             path: '/users-management',
             component: UsersManagementPage
        }
    ]
});

export default router;
