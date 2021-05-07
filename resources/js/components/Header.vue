<template>
    <div class="flex_header">
        <div class="logo"><img src="/images/logo_foot2.svg" alt="logo">
        </div>
        <div class="accoun_flex">
            <div class="user_name">{{ user.name }}</div>
            <div><img src="/images/placeholder.png" alt=""></div>
            <div class="dropdown">
                <button class="btn drop dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">
                    <router-link to="/profile" class="dropdown-item drop_links">Мой профиль</router-link>
                    <div class="dropdown-divider"></div>
                    <router-link :to="{name: 'settings.login'}" class="dropdown-item drop_links ">Настройки безопасности</router-link>
                    <div class="dropdown-divider"></div>
                    <a to="#" class="dropdown-item drop_links" @click.prevent="logout">Выход из системы</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "Header",
    data() {
        return{
            show:false,
            user:{
                name:'Марина'
            }
        }
    },
    methods: {
        ...mapActions([
            'saveUserFromServer',
            'saveAccessFromServer',
            'saveRefreshFromServer'
        ]),
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
        ]),
    },

}
</script>

<style scoped>

</style>
