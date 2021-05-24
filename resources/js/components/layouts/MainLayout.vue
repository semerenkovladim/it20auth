<template>
    <main class="main_component">
        <header-component/>
        <div class="main_component__container container-fluid">
            <div class="row">
                <div class="col-12 main_home">
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
    components: {Sidebar, HeaderComponent, FooterComponent},
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.main_component {
    padding-top: $headerHeight;
    padding-left: $navWidth;
    @media all and (max-width: 768px) {
        padding-left: 0;
    }
}
.main_component__container {
    min-height: 100vh;
}
</style>
