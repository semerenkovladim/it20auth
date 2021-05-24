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
import DepartmentsManagement from "../pages/Department/DepartmentsManagement";
import DepartmentCreate from "../pages/Department/DepartmentCreate";
import DepartmentEdit from "../pages/Department/DepartmentEdit";
import TitleComponent from '../components/slider/TitleComponent.vue'
import SettingsSecure from "../pages/settings-secure/SettingsSecure";
import AccountLogin from "../pages/settings-secure/components/AccountLogin";
import HistoryList from "../pages/settings-secure/components/HistoryList";
import TheLoginTwoFactor from "../pages/auth/TheLoginTwoFactor";
import TheLoginCode from "../pages/auth/TheLoginCode";
import middlewarePipeline from "./middlewarePipeline";
import isLogin from './isLogin';
import trimQuery from './trimQuery';
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
            meta: {
              middleware: [
                  trimQuery,
              ]
            },
            children: [
                {
                    path: '/',
                    name: 'login.index',
                    component: TheLogin,
                    meta: {
                        middleware: [
                            trimQuery,
                        ],
                    },
                },
                {
                    path: 'two-step',
                    name: 'login.two-step',
                    component: TheLoginTwoFactor,
                    meta: {
                        middleware: [
                            trimQuery,
                        ],
                    },
                },
                {
                    path: 'code',
                    name: 'login.code',
                    component: TheLoginCode,
                    meta: {
                        middleware: [
                            trimQuery,
                        ],
                    },
                },
                {
                    path: 'repair-password',
                    name: 'login.repair',
                    component: TheRepairPassword,
                    meta: {
                        middleware: [
                            trimQuery,
                        ],
                    },
                },
                {
                    path: 'repair-password/code',
                    name: 'login.repair.code',
                    component: TheRepairPasswordCode,
                    meta: {
                        middleware: [
                            trimQuery,
                        ],
                    },
                },
                {
                    path: 'repair-password/new-password',
                    name: 'login.repair.new',
                    component: TheRepairPasswordNew,
                    meta: {
                        middleware: [
                            trimQuery,
                        ],
                    },
                },
                {
                    path: 'repair-password/code-word',
                    name: 'login.repair.word',
                    component: TheRepairPasswordCodeWord,
                    meta: {
                        middleware: [
                            trimQuery,
                        ],
                    },
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
                            isLogin,
                            trimQuery,
                        ]
                    }
                },
                {
                    path: '/profile',
                    component: Profile,
                    meta: {
                        middleware: [
                            isLogin,
                            trimQuery,
                        ]
                    }
                },
                {
                    path: '/users-management',
                    component: UsersManagementPage,
                    meta: {
                        middleware: [
                            isLogin,
                            trimQuery,
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
                            isLogin,
                            trimQuery,
                        ]
                    }
                },
                {
                    path: '/users-management/new-user',
                    component: NewUserPage,
                    meta: {
                        middleware: [
                            isLogin,
                            trimQuery,
                        ]
                    }
                },
                {
                    path: '/departments-management',
                    component: DepartmentsManagement,
                    name: 'DepartmentsManagement',
                    meta: {
                        middleware: [
                            isLogin,
                            trimQuery,
                        ]
                    }

                },
                {
                    path: '/departments-management/create',
                    component: DepartmentCreate,
                    name: 'DepartmentCreate',
                    meta: {
                        middleware: [
                            isLogin,
                            trimQuery,
                        ]
                    }
                },
                {
                    path: '/departments-management/edit/',
                    component: DepartmentEdit,
                    name: 'DepartmentEdit',
                    meta: {
                        middleware: [
                            isLogin,
                            trimQuery,
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
                                    isLogin,
                                    trimQuery,
                                ]
                            }
                        },
                        {
                            path: 'history',
                            name: 'settings.history',
                            component: HistoryList,
                            meta: {
                                middleware: [
                                    isLogin,
                                    trimQuery,
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
