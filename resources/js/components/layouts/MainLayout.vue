<template>
    <main>
        <header-component/>
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 sidebar">
                    <sidebar/>
                </div>
                <div class="col-10 main_home">
                    <router-view></router-view>
                </div>
            </div>
        </div>
        <footer-component/>
    </main>
</template>

<script>
import HeaderComponent from "../Header";
import Sidebar from "../Sidebar";
import FooterComponent from "../Footer";
export default {
    name: "MainLayout",
    components: {Sidebar, HeaderComponent, FooterComponent}
}
</script>

<style scoped>

</style>
