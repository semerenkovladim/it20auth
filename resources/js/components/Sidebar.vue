<template>
    <ul>
        <li class="link"><router-link to="/home" class="wiget"><div class="home"></div><div class="sidebar_link">Главная страница</div></router-link></li>
        <li class="link"><router-link to="/" class="wiget"><div class="dick"></div><span>Диск</span></router-link></li>
        <li class="link"><router-link to="/" class="wiget"><div class="post"></div> <span class="sidebar_link">Почта</span></router-link></li>
        <li class="link"><router-link to="/" class="wiget"> <div class="calendar"></div><span class="sidebar_link">Календарь</span></router-link></li>
        <li class="link"><router-link to="/" class="wiget"> <div class="photo"></div> <span class="sidebar_link">Фото</span></router-link></li>
        <li class="link"><router-link to="/" class="wiget"> <div class="contact"></div> <span class="sidebar_link">Контакты</span></router-link></li>
        <li class="link">
            <div class="wiget" @click="showMenu = !showMenu">
                <div class="control"></div>
                <span>Управление</span>
            </div>
        </li>
        <li class="link" v-if="showMenu"><router-link to="/" class="wiget"> <div class="location"></div> <span>Отделы</span></router-link></li>
        <li class="link" v-if="showMenu"><router-link to="/" class="wiget"> <div class="contact"></div> <span>Пользователи</span></router-link></li>
    </ul>
</template>

<script>
export default {
    name: "Sidebar",
    data() {
        return{
            showMenu:false
        }
    },
}
</script>

<style scoped>

</style>
