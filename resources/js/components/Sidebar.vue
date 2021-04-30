<template>
    <ul>
        <li class="link"><router-link to="/home" class="wiget"><div class="home"></div><span>Главная страница</span></router-link></li>
        <li class="link"><router-link to="/" class="wiget"><div class="dick"></div><span>Диск</span></router-link></li>
        <li class="link"><router-link to="/" class="wiget"><div class="post"></div> <span>Почта</span></router-link></li>
        <li class="link"><router-link to="/" class="wiget"> <div class="calendar"></div><span>Календарь</span></router-link></li>
        <li class="link"><router-link to="/" class="wiget"> <div class="photo"></div> <span>Фото</span></router-link></li>
        <li class="link"><router-link to="/" class="wiget"> <div class="contact"></div> <span>Контакты</span></router-link></li>
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
