<template>
    <header class="flex_header">
        <div class="sidebar_wrapper">
            <div class="logo">
                <img src="/images/logo_foot2.svg"
                     alt="logo"
                     @click="$route.path !== '/home'? $router.push('/home'):''">
            </div>
            <div class="sidebar_btn_wrapper">
                <button class="new_style sidebar_arrow"
                        v-if="!show"
                        @click="show=!show" key="menu">
                </button>
                <button class="old_style sidebar_arrow"
                        v-else
                        @click="show=!show" key="menu">
                </button>
            </div>
            <Sidebar class="auth_sidebar" :show="show" @closeEvent="toggleShow"></Sidebar>
        </div>
        <div class="account_flex">
            <div class="user_name">{{ user.surname }} {{ user.name }}</div>
            <div class="avatar_wrapper"
                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img :src="user.avatar" alt="avatar" v-if="user.avatar">
                <div class="initials" v-else>{{ setInitials(user.surname, user.name) }}</div>
            </div>
            <div class="dropdown">
                <button class="btn drop dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left"
                     aria-labelledby="dropdownMenuButton">
                    <router-link to="/profile" class="dropdown-item drop_links">Мой профиль</router-link>
                    <div class="dropdown-divider"></div>
                    <router-link :to="{name: 'settings.login'}" class="dropdown-item drop_links ">Настройки
                        безопасности
                    </router-link>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item drop_links" @click.prevent="logout">Выход из системы</a>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import Sidebar from "./Sidebar";

export default {
    name: "Header",
    components: {
        Sidebar
    },
    data() {
        return {
            show: false,
        }
    },
    methods: {
        ...mapActions([
            'saveUserFromServer',
            'saveAccessFromServer',
            'saveRefreshFromServer',
        ]),
        toggleShow() {
            this.show = false
        },
        logout() {
            axios.post('/api/logout', {}, {
                headers: {
                    'Authorization': `Bearer ` + this.access_token
                }
            }).then(() => {
                this.saveUserFromServer(null);
                this.saveAccessFromServer(null);
                this.saveRefreshFromServer(null);
                this.$router.push({name: 'login.index'});
            })
        },
    },
    computed: {
        ...mapGetters([
            'access_token',
            'user'
        ]),
        setInitials() {
             if (this.user.surname && this.user.name) {
                 return this.user.surname.slice(0, 1) + ' ' + this.user.name.slice(0, 1)
             }
        },
    },

}
</script>

<style lang="scss">
@import "resources/sass/variables";

.sidebar_wrapper {
    transition: 0.2s ease;
    position: relative;
    display: flex;
    width: 100%;
    max-width: 255px;

    .logo {
        display: flex;
        align-items: center;
        height: $headerHeight;
        width: 100%;
        max-width: 170px;
        position: relative;
        cursor: pointer;
        @media all and (max-width: 768px) {
            max-width: 100px;
        }

        img {
            width: 100%;
            position: absolute;
            z-index: 1015;
        }
    }
}

.sidebar_wrapper-active {
    max-width: 255px;
}

.sidebar_btn_wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    right: 10px;
    height: 100%;
    z-index: 1005;
}

.sidebar_arrow {
    display: block;
    padding: 0;
    height: 26px;
    width: 26px;
    z-index: 1010;
}

.auth_sidebar {
    z-index: 999;
    top: 0;
    padding-top: $headerHeight;
    left: 0;
    position: fixed;
    //transition: 0.2s ease;
    transition: width, height, flex, max-width, min-width, transform, justify, align ease;
    transition-duration: 0.2s;

    > * {
        transition: 0.2s ease;
    }

    @media all and (max-width: 500px) {
        width: 100%;
        max-width: 100%;
    }

}

.flex_header {
    position: fixed;
    z-index: 998;
    top: 0;
    left: 0;
    width: 100%;
    background: #FFFFFF;
    min-height: $headerHeight;
    margin: 0;
    align-items: unset;
    padding-right: 15px;

    &:after {
        content: '';
        display: block;
        position: absolute;
        height: 10px;
        bottom: 0;
        left: 0;
        width: 100%;
        box-shadow: 0 3px 3px 0 rgb(0 0 0 / 5%);
        z-index: 1002;
    }


    .user_name {
        line-height: 1;
    }

    .avatar_wrapper {
        cursor: pointer;
        display: flex;
        width: 50px;
        height: 50px;
        position: relative;
        overflow: hidden;
        border-radius: 50%;
        flex: none;

        img {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .initials {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            background: #ccc;
            color: #fff;
            font-size: 18px;
        }
    }

    .account_flex {
        z-index: 1030;
        position: relative;
    }

    .dropdown {
        position: static !important;
    }

    .dropdown-toggle {
        background: url("../../images/icons/ic_keyboard_arrow_down.png") no-repeat center;
        width: 26px;
        height: 26px;
        margin-left: 7px;
        @media all and (max-width: 500px) {
            display: none !important;
        }

        &:active, &:focus {
            outline: none;
            box-shadow: none;
        }

        &:after {
            content: '';
            display: none;
        }
    }

    .dropdown-menu {
        min-width: 255px;
        position: absolute;
        bottom: 0 !important;
        top: auto !important;
        right: 0 !important;
        left: auto !important;
        //background: #DADADA;
        transform: translate3d(0, calc(100% + 7px), 0) !important;
        height: fit-content;
        padding: 0;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);

        a {
            font-weight: 500;
            font-size: 13px;
            text-align: center;
            color: #808080;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border-bottom: 2px solid #F5F5F5;

            &:first-child {
                position: relative;
                border-radius: 6px 6px 0 0;

                &:before {
                    content: '';
                    position: absolute;
                    top: 0;
                    transform: translateY(-25%) rotate(45deg);
                    right: 25px;
                    display: block;
                    width: 15px;
                    height: 15px;
                    background: #fff;
                    z-index: -1;
                    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);

                }
            }

            &:last-child {
                border-bottom: none;
                border-radius: 0 0 6px 6px;
            }
        }

        .dropdown-divider {
            display: none;
        }

        .dropdown-item.active, .dropdown-item:hover {
            background: #FFFFFF;
            color: $designColorOne;
        }
    }
}


</style>
