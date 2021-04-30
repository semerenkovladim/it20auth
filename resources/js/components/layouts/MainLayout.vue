<template>
    <main>
        <header-component/>
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    <sidebar/>
                </div>
                <div class="col-10">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import HeaderComponent from "../Header";
import Sidebar from "../Sidebar";
export default {
    name: "MainLayout",
    components: {Sidebar, HeaderComponent}
}
</script>

<style scoped>

</style>
