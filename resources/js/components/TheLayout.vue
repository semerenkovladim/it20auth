<template>
    <router-view></router-view>
</template>

<script>

import UsersManagementPage from "./UsersManagement/views/UsersManagementPage";
export default {
    name: "TheLayout",
    components:{
        'users-management-page': UsersManagementPage
    }
}
</script>

<style scoped>
</style>
