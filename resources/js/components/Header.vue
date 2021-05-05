<template>
    <div class="flex_header">
        <div class="logo"><img src="images/logo_foot2.svg" alt="logo">
        </div>
        <div class="accoun_flex">
            <div class="user_name">Анна Кононенко</div>
            <div><img src="images/placeholder.png" alt=""></div>
            <div class="dropdown">
                <button class="btn drop dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">
                    <router-link to="/profile" class="dropdown-item drop_links">Мой профиль</router-link>
                    <div class="dropdown-divider"></div>
                    <router-link to="/" class="dropdown-item drop_links ">Настройки безопасности</router-link>
                    <div class="dropdown-divider"></div>
                    <router-link to="/" class="dropdown-item drop_links">Выход из системы</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Header",
    data() {
        return{
            show:false
        }
    }
}
</script>

<style scoped>

</style>
