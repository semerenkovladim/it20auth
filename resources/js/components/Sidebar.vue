<template>
    <ul>
        <button class="new_style" v-if="!show" @click="show=!show" key="menu"></button>
        <button class="old_style" v-else @click="show=!show" key="menu"></button>
        <li class="link" v-bind:class="{'linkss':show}">
            <router-link to="/home" class="wiget">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'home2':show, 'home':!show}"></div>
                    <div>Главная страница</div>
                </div>
            </router-link>
        </li>
        <li class="link" v-bind:class="{'linkss':show}">
            <router-link to="/" class="wiget">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'dick2':show, 'dick':!show}"></div>
                    <div>Диск</div>
                </div>
            </router-link>
        </li>
        <li class="link" v-bind:class="{'linkss':show}">
            <router-link to="/" class="wiget">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'post2':show, 'post':!show}"></div>
                    <div>Почта</div>
                </div>
            </router-link>
        </li>
        <li class="link" v-bind:class="{'linkss':show}">
            <router-link to="/" class="wiget">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'calendar2':show, 'calendar':!show}"></div>
                    <div>Календарь</div>
                </div>
            </router-link>
        </li>
        <li class="link" v-bind:class="{'linkss':show}">
            <router-link to="/" class="wiget">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'photo2':show, 'photo':!show}"></div>
                    <div>Фото</div>
                </div>
            </router-link>
        </li>
        <li class="link" v-bind:class="{'linkss':show}">
            <router-link to="/" class="wiget">
                <div v-bind:class="{'flex':show}">
                    <div v-bind:class="{'contact2':show, 'contact':!show}"></div>
                    <div>Контакты</div>
                </div>
            </router-link>
        </li>
        <li class="link " v-bind:class="{'linkss':show}">
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
            </router-link></li>
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
export default {
    name: "Sidebar",
    data() {
        return{
            showMenu:false,
            show:false
        }
    },
}
</script>

<style scoped>

</style>
