<template>
    <footer class="footer">
        <div class="container-fluid footer_content">
            <div class="row">
                <div class="col-md-4 policy">
                    <div class="policy_photo"></div>
                    <div class="prave">Все права защищены</div>
                    <div>© OOO «IT 2.0»</div>
                </div>
                <div class="col-md-4 menu">
                    <div class="title_menu">Инструменты</div>
                    <div class="container">
                        <div class="row menu_content">
                            <div class="col-6">Диск</div>
                            <div class="col-6">Почта</div>
                            <div class="col-6">Календарь</div>
                            <div class="col-6">Фото</div>
                            <div class="col-6">Контакты</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 footer_contact">
                    <div class="title_contact">Контакты</div>
                    <div class="container">
                        <div class="row contact_f">
                            <div class="col_link"> <a href="tel:+380959003800">+38 (099) 607-87-26</a></div>
                            <div class="col_link"> <a href="mailto:mail@aiti20.com">mail@aiti20.com</a></div>
                        </div>
                        <div class="background_line"></div>
                        <div class="col-12 col-md-6  text-center text-md-left flex icon_social">
                            <a href="https://www.facebook.com/" class="facebook"></a>
                            <a href="https://www.facebook.com/" class="twitter"></a>
                            <a href="https://www.instagram.com" class="instagram"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style lang="scss">
.contact_f {
    .col_link {
        flex: 1 1 50%;
        min-width: fit-content;
        padding: 0 15px;
    }
}
.footer_content {
   > .row {
       width: 100%;
   }
}
</style>
