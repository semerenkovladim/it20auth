import Vue from 'vue';
import VueRouter from 'vue-router';
import TheLogin from "../pages/auth/TheLogin";
import TheAuth from "../components/layouts/TheAuth";
import TheRepairPassword from "../pages/auth/TheRepairPassword";
import TheRepairPasswordCode from "../pages/auth/TheRepairPasswordCode";
import TheRepairPasswordNew from "../pages/auth/TheRepairPasswordNew";
import UsersManagementPage from "../pages/usersManagement/UsersManagementPage";
import UserEditPage from "../pages/userEdit/UserEditPage";
import NewUserPage from "../pages/newUser/NewUserPage";
// import * as path from "path";

Vue.use(VueRouter);


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
            component: UsersManagementPage,
        },
        {
            path: '/users-management/user-edit',
            component: UserEditPage
        },
        {
            path: '/users-management/new-user',
            component: NewUserPage
        }
    ]
});

export default router;
