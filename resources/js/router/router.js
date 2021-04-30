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
import DepartmentsManagementList from "../pages/Department/DepartmentsManagementList";
import DepartmentCreate from "../pages/Department/DepartmentCreate";
import MainLayout from "../components/layouts/MainLayout";
import Home from "../pages/home/Home";
import Profile from "../pages/profile/Profile";

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
            path: '/',
            name: 'base',
            component: MainLayout,
            children: [
                {
                    path: '/home',
                    component: Home
                },
                {
                    path: '/profile',
                    component: Profile
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
                },
                {
                    path: '/departments-management',
                    component: DepartmentsManagementList,
                },
                {
                    path: '/departments-create',
                    component: DepartmentCreate,
                },

            ]
        },

    ]
});

export default router;
