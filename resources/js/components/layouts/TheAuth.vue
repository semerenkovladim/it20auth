<template>
    <div class="background">
        <div class="container-fluid h-100">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    name: "TheAuth"
}
</script>

<style scoped>
.background {
    background: url("../../../images/login_bg.png");
    background-repeat: no-repeat;
    background-size: cover;
    width: 100vw;
    height: 100vh;
}
</style>
