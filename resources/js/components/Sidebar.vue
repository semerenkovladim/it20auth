<template>
    <ul class="sidebar_list" :class="{'sidebar_list-active':show}">
        <li class="link" v-bind:class="{'linkss':show}">
            <router-link to="/home" class="wiget">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'home2':show, 'home':!show}"></div>
                    <div>Главная страница</div>
                </div>
            </router-link>
        </li>
        <li class="link" v-bind:class="{'linkss':show}" v-if="user.access_level.disk">
            <router-link to="/" class="wiget">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'dick2':show, 'dick':!show}"></div>
                    <div>Диск</div>
                </div>
            </router-link>
        </li>
        <li class="link" v-bind:class="{'linkss':show}" v-if="user.access_level.mail">
            <router-link to="/" class="wiget">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'post2':show, 'post':!show}"></div>
                    <div>Почта</div>
                </div>
            </router-link>
        </li>
        <li class="link" v-bind:class="{'linkss':show}" v-if="user.access_level.calendar">
            <router-link to="/" class="wiget">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'calendar2':show, 'calendar':!show}"></div>
                    <div>Календарь</div>
                </div>
            </router-link>
        </li>
        <li class="link" v-bind:class="{'linkss':show}" v-if="user.access_level.photo">
            <router-link to="/" class="wiget">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'photo2':show, 'photo':!show}"></div>
                    <div>Фото</div>
                </div>
            </router-link>
        </li>
        <li class="link" v-bind:class="{'linkss':show}" v-if="user.access_level.contacts">
            <router-link to="/" class="wiget">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'contact2':show, 'contact':!show}"></div>
                    <div>Контакты</div>
                </div>
            </router-link>
        </li>
        <li class="link " v-bind:class="{'linkss':show}" v-if="user.is_admin">
            <a class="wiget" @click.prevent="showMenu = !showMenu">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'control2':show, 'control':!show}"></div>
                    <div>Управление</div>
                </div>
            </a>
        </li>
        <li class="link" v-bind:class="{'linkss':show}" v-if="showMenu">
            <router-link to="/departments-management" class="wiget">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'location2':show, 'location':!show}"></div>
                    <span>Отделы</span>
                </div>
            </router-link>
        </li>
        <li class="link" v-bind:class="{'linkss':show}" v-if="showMenu">
            <router-link to="/users-management" class="wiget">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'contact2':show, 'contact':!show}"></div>
                    <div>Пользователи</div>
                </div>
            </router-link>
        </li>
    </ul>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "Sidebar",
    props: ['show'],
    data() {
        return {
            showMenu: false,
            user:{
                is_admin:false,
                access_level: {
                    disk: 0,
                    mail: 0,
                    contacts: 0,
                    photo: 0,
                    calendar: 0
                }
            },
        }
    },
    computed:{
        auth_user(){
            return this.$store.getters.user;
        }
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.sidebar_list {
    @media all and (max-width: 768px) {
        transform: translate(-100%);
    }
    background: #FFFFFF;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    height: 100%;
    position: relative;
    width: 100%;
    max-width: 160px;

    .link {
        padding: 0;
        border: none;
        background: #FFFFFF;

        a {
            display: block;
            padding: 0;
            border-right: 2px solid transparent;
            border-left: 2px solid transparent;

            * {
                transition: none;
            }

            &:hover {
                border-left: 2px solid #1875F0;
            }
        }

        .active {
            color: #0056b3;
            border-left: 2px solid #1875F0;
        }
    }
}

.sidebar_list-active {
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    border-radius: 6px;
    max-width: 255px;
    height: auto;
    overflow: hidden;
    background: transparent;
    @media all and (max-width: 768px) {
        transform: translate(0);
    }
}

</style>
