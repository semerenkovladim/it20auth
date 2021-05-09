import Vue from 'vue';
import VueRouter from 'vue-router';
import TheLogin from "../pages/auth/TheLogin";
import TheAuth from "../components/layouts/TheAuth";
import TheRepairPassword from "../pages/auth/TheRepairPassword";
import TheRepairPasswordCode from "../pages/auth/TheRepairPasswordCode";
import TheRepairPasswordNew from "../pages/auth/TheRepairPasswordNew";
import UsersManagementPage from "../pages/usersManagement/UsersManagementPage";
import Profile from '../pages/Profile.vue'
import Home from "../pages/home/Home";
import MainLayout from "../components/layouts/MainLayout";
import UserEditPage from "../pages/userEdit/UserEditPage";
import NewUserPage from "../pages/newUser/NewUserPage";
import DepartmentsManagementList from "../pages/Department/DepartmentsManagementList";
import DepartmentCreate from "../pages/Department/DepartmentCreate";
import TitleComponent from '../components/slider/TitleComponent.vue'
import SettingsSecure from "../pages/settings-secure/SettingsSecure";
import AccountLogin from "../pages/settings-secure/components/AccountLogin";
import HistoryList from "../pages/settings-secure/components/HistoryList";
import TheLoginTwoFactor from "../pages/auth/TheLoginTwoFactor";
import TheLoginCode from "../pages/auth/TheLoginCode";
import middlewarePipeline from "./middlewarePipeline";
import isLogin from './isLogin';
import TheRepairPasswordCodeWord from "../pages/auth/TheRepairPasswordCodeWord";
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
                    path: 'two-step',
                    name: 'login.two-step',
                    component: TheLoginTwoFactor
                },
                {
                    path: 'code',
                    name: 'login.code',
                    component: TheLoginCode
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
                },
                {
                    path: 'repair-password/code-word',
                    name: 'login.repair.word',
                    component: TheRepairPasswordCodeWord
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
                    component: Home,
                    meta: {
                        middleware: [
                            isLogin
                        ]
                    }
                },
                {
                    path: '/profile',
                    component: Profile,
                    meta: {
                        middleware: [
                            isLogin
                        ]
                    }
                },
                {
                    path: '/users-management',
                    component: UsersManagementPage,
                    meta: {
                        middleware: [
                            isLogin
                        ]
                    }
                },
                {
                    path: '/users-management/user-edit',
                    component: UserEditPage,
                    name:'users-management/user-edit',
                    params: true,
                    meta: {
                        middleware: [
                            isLogin
                        ]
                    }
                },
                {
                    path: '/users-management/new-user',
                    component: NewUserPage,
                    meta: {
                        middleware: [
                            isLogin
                        ]
                    }
                },
                {
                    path: '/departments-management',
                    component: DepartmentsManagementList,
                    meta: {
                        middleware: [
                            isLogin
                        ]
                    }

                },
                {
                    path: '/departments-create',
                    component: DepartmentCreate,
                    meta: {
                        middleware: [
                            isLogin
                        ]
                    }
                },
                {
                    path: '/settings-secure',
                    component: SettingsSecure,
                    name: 'setting.base',
                    children: [
                        {
                            path: 'account-login',
                            name: 'settings.login',
                            component: AccountLogin,
                            meta: {
                                middleware: [
                                    isLogin
                                ]
                            }
                        },
                        {
                            path: 'history',
                            name: 'settings.history',
                            component: HistoryList,
                            meta: {
                                middleware: [
                                    isLogin
                                ]
                            }
                        }
                    ]
                }
            ]
        },
    ]
});
router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) {
        return next()
    }
    const middleware = to.meta.middleware
    const context = {
        to,
        from,
        next
    }
    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1)
    })
})
export default router;
