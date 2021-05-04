<template>
    <ul>
        <button class="new_style" v-if="!show" @click="show=!show" key="menu"></button>
        <button class="old_style" v-else @click="show=!show" key="menu"></button>
        <li class="link" v-bind:class="{'linkss':show}"><router-link to="/home" class="wiget"><div v-bind:class="{'flex':show}"><div v-bind:class="{'home2':show, 'home':!show}"></div><div>Главная страница</div></div></router-link></li>
        <li class="link" v-bind:class="{'linkss':show}"><router-link to="/" class="wiget"><div v-bind:class="{'flex':show}"><div v-bind:class="{'dick2':show, 'dick':!show}"></div><span>Диск</span></div></router-link></li>
        <li class="link" v-bind:class="{'linkss':show}"><router-link to="/" class="wiget"><div v-bind:class="{'flex':show}"><div v-bind:class="{'post2':show, 'post':!show}"></div><span >Почта</span></div></router-link></li>
        <li class="link" v-bind:class="{'linkss':show}"><router-link to="/" class="wiget"><div v-bind:class="{'flex':show}"><div v-bind:class="{'calendar2':show, 'calendar':!show}"></div> <span >Календарь</span></div></router-link></li>
        <li class="link" v-bind:class="{'linkss':show}"><router-link to="/" class="wiget"><div v-bind:class="{'flex':show}"><div v-bind:class="{'photo2':show, 'photo':!show}"></div> <span >Фото</span></div></router-link></li>
        <li class="link" v-bind:class="{'linkss':show}"><router-link to="/" class="wiget"><div v-bind:class="{'flex':show}"><div v-bind:class="{'contact2':show, 'contact':!show}"></div> <span>Контакты</span></div></router-link></li>
        <li class="link " v-bind:class="{'linkss':show}">
        <div class="wiget" v-bind:class="{'flex':show}" @click="showMenu = !showMenu"><div v-bind:class="{'control2':show, 'control':!show}"></div><span>Управление</span></div>
        </li>
        <li class="link" v-bind:class="{'linkss':show}" v-if="showMenu"><router-link to="/" class="wiget" v-bind:class="{'flex':show}"> <div v-bind:class="{'location2':show, 'location':!show}"></div> <span>Отделы</span></router-link></li>
        <li class="link" v-bind:class="{'linkss':show}" v-if="showMenu"><router-link to="/" class="wiget" v-bind:class="{'flex':show}"> <div v-bind:class="{'contact2':show, 'contact':!show}"></div> <span>Пользователи</span></router-link></li>
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
