<template>
    <div class="wrapper">
        <div class="top-section">
            <div class="title">Настройки безопасности</div>
            <div class="nav-tabs-wrapper">
                <ul class="nav-tabs-items">
                    <li class="nav-tabs-item">
                        <router-link active-class="active-tabs-link" :to="{name: 'settings.login'}" class="nav-tabs-link">Вход в аккаунт</router-link>
                    </li>
                    <li class="nav-tabs-item">
                        <router-link active-class="active-tabs-link" :to="{name: 'settings.history'}" class="nav-tabs-link">История</router-link>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-nav">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    name: "SettingsSecure",
    data() {
        return {
            accountActive: false,
            historyActive: false,
        }
    },
    created() {
        const path = this.$route.path.slice(this.$route.path.lastIndexOf('/') + 1);
        if(path !== 'history' && path !== 'account-login') {
            this.$router.push({name: 'settings.login'});
            this.accountActive = true;
        }
        else if(path === 'history') {
            this.historyActive = true;
        }
        else {
            this.accountActive = true;
        }

    }
}
</script>

<style scoped>
.nav-tabs-items {
    display: flex;
}
.nav-tabs-item {
    margin-right: 18px;
    padding-bottom: 28px;
}
.nav-tabs-link {
    padding-bottom: 28px;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 20px;
    text-align: center;
    color: #B2B2B2;
    text-decoration: none;
}
.active-tabs-link {
    font-weight: bold;
    color: #1875F0;
    border-bottom: 2px solid #1875F0;
}
.top-section {
    padding-top: 30px;
    padding-left: 11px;
    background: #FFFFFF;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.05);
    box-sizing: border-box;
}
.title {
    font-style: normal;
    font-weight: 300;
    font-size: 36px;
    line-height: 90px;
    color: #808080;
    text-align: left;
    margin-bottom: 20px;
}
.nav-tabs-item:last-child {
    margin-right: 0;
}
</style>
