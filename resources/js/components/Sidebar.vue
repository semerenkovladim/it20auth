<template>
    <div class="sidebar_list" :class="{'sidebar_list-active':show}">
        <ul class="sidebar">
            <li class="link" v-bind:class="{'linkss':show}"
                @click="$emit('closeEvent')">
                <router-link to="/home" class="wiget">
                    <div v-bind:class="{'flex':show}">
                        <div v-bind:class="{'home2':show, 'home':!show}"
                        class="nav_image"></div>
                        <div>Главная страница</div>
                    </div>
                </router-link>
            </li>
            <li class="link" v-bind:class="{'linkss':show}"
                v-if="user.access_level.disk"
                @click="$emit('closeEvent')">
                <a href="http://disk.hardsoft.space/" class="wiget">
                    <div v-bind:class="{'flex':show}">
                        <div v-bind:class="{'dick2':show, 'dick':!show}"
                        class="nav_image"></div>
                        <div>Диск</div>
                    </div>
                </a>
            </li>
            <li class="link" v-bind:class="{'linkss':show}"
                v-if="user.access_level.mail"
                @click="$emit('closeEvent')">
                <router-link to="/" class="wiget">
                    <div v-bind:class="{'flex':show}">
                        <div v-bind:class="{'post2':show, 'post':!show}"
                        class="nav_image"></div>
                        <div>Почта</div>
                    </div>
                </router-link>
            </li>
            <li class="link" v-bind:class="{'linkss':show}"
                v-if="user.access_level.calendar"
                @click="$emit('closeEvent')">
                <a href="http://a0543833.xsph.ru/" class="wiget">
                    <div v-bind:class="{'flex':show}">
                        <div v-bind:class="{'calendar2':show, 'calendar':!show}"
                        class="nav_image"></div>
                        <div>Календарь</div>
                    </div>
                </a>
            </li>
            <li class="link" v-bind:class="{'linkss':show}"
                v-if="user.access_level.photo"
                @click="$emit('closeEvent')">
                <a href="http://www.ignatenko-project.store/checkPhoto" class="wiget">
                    <div v-bind:class="{'flex':show}">
                        <div v-bind:class="{'photo2':show, 'photo':!show}"
                        class="nav_image"></div>
                        <div>Фото</div>
                    </div>
                </a>
            </li>
            <li class="link" v-bind:class="{'linkss':show}"
                v-if="user.access_level.contacts"
                @click="$emit('closeEvent')">
                <a href="http://calendar.hardsoft.space/" class="wiget">
                    <div v-bind:class="{'flex':show}">
                        <div v-bind:class="{'contact2':show, 'contact':!show}"
                        class="nav_image"></div>
                        <div>Контакты</div>
                    </div>
                </a>
            </li>
            <li class="link " v-bind:class="{'linkss':show}" v-if="user.is_admin">
                <a class="wiget" @click.prevent="showMenu = !showMenu">
                    <div v-bind:class="{'flex':show}">
                        <div v-bind:class="{'control2':show, 'control':!show}"
                        class="nav_image"></div>
                        <div>Управление</div>
                    </div>
                </a>
            </li>
            <li class="link" v-bind:class="{'linkss':show}"
                v-if="showMenu"
                @click="$emit('closeEvent')">
                <router-link to="/departments-management" class="wiget">
                    <div v-bind:class="{'flex':show}">
                        <div v-bind:class="{'location2':show, 'location':!show}"
                        class="nav_image"></div>
                        <span>Отделы</span>
                    </div>
                </router-link>
            </li>
            <li class="link" v-bind:class="{'linkss':show}"
                v-if="showMenu"
                @click="$emit('closeEvent')">
                <router-link to="/users-management" class="wiget">
                    <div v-bind:class="{'flex':show}">
                        <div v-bind:class="{'contact2':show, 'contact':!show}"
                        class="nav_image"></div>
                        <div>Пользователи</div>
                    </div>
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "Sidebar",
    props: ['show'],
    data() {
        return {
            showMenu: false,
            user: {
                is_admin: false,
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
<<<<<<< HEAD
    computed:{
        auth_user(){
=======
    methods: {
        ...mapActions([
            'getProfile'
        ])
    },
    async mounted() {
        await this.getProfile(this.auth_user.id)
        this.user = Object.assign(this.user, this.auth_user)
        console.log('User', this.user)
    },
    computed: {
        auth_user() {
>>>>>>> ef1f5008cb8379f5c9cb2e0ae3b359110fb51749
            return this.$store.getters.user;
        }
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.sidebar {
    width: 100%;
}
.nav_image {
    background: #D8D8D8;
    padding-bottom: 30px;
}
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
            .nav_image {
               transition: 0.2s;
            }
            &:hover {
                color: #666666;
                border-left: 2px solid #1875F0;
                .nav_image {
                    background: #1875F0;
                }
            }
        }

        .active {
            color: #666666;
            border-left: 2px solid #1875F0;
            .nav_image {
                background: #1875F0;
            }
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
