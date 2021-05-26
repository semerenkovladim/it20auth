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
                <a href="http://contacts.hardsoft.space" class="wiget">
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
import {mapActions, mapGetters} from "vuex";

export default {
    name: "Sidebar",
    props: ['show'],
    data() {
        return {
            showMenu: false,
        }
    },
    methods: {
        ...mapActions([
            'getProfile'
        ])
    },
    created() {
        let vm = this;
        document.onclick = (el) => {
            if (window.innerWidth < 768) {
                if (!el.target.closest('.sidebar') && !el.target.closest('.sidebar_arrow')) vm.$emit('closeEvent');
            }
        }
    },
    computed: {
        ...mapGetters([
            'user',
        ]),
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.sidebar {
    width: 100%;

    .wrapper {
        width: 100vw;
        height: 100vh;
    }
}

.nav_image {
    background: #D8D8D8;
    padding-bottom: 30px;
}

.sidebar_list {
    background: #FFFFFF;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    height: 100%;
    position: relative;
    width: 100%;
    max-width: 160px;
    @media all and (max-width: 768px) {
        transform: translate(-100%);
        height: fit-content;

    }
    .link {
        padding: 0;
        border: none;
        background: #FFFFFF;

        .wiget {
            padding-top: 12px;
        }

        a {
            display: block;
            padding: 0;
            border-right: 2px solid transparent;
            border-left: 2px solid transparent;
            transition: none;

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

    .link .wiget {
        padding-top: 0;
    }

    @media all and (max-width: 768px) {
        transform: translate(0);
        .wrapper {
            width: 100vw;
            height: 100vh;
        }
    }
}

</style>
