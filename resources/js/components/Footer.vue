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
                            <div class="col-6"><a class="footer_link" href="http://disk.hardsoft.space/">Диск</a></div>
                            <div class="col-6"><router-link to="/" class="footer_link">Почта</router-link></div>
                            <div class="col-6"><a class="footer_link" href="http://calendar.hardsoft.space/">Календарь</a></div>
                            <div class="col-6"><a class="footer_link" href="http://www.ignatenko-project.store/checkPhoto">Фото</a></div>
                            <div class="col-6"><a class="footer_link" href="http://a0543833.xsph.ru/">Контакты</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 footer_contact">
                    <div class="title_contact">Контакты</div>
                    <div class="container">
                        <div class="row contact_f">
                            <div class="col_link"><a href="tel:+380959003800">+38 (099) 607-87-26</a></div>
                            <div class="col_link"><a href="mailto:mail@aiti20.com">mail@aiti20.com</a></div>
                        </div>
                        <div class="background_line"></div>
                        <ul class="icon_social">
                            <li class="icon_social__item"><a href="https://www.facebook.com/" class="facebook"></a></li>
                            <li class="icon_social__item"><a href="https://www.facebook.com/" class="twitter"></a></li>
                            <li class="icon_social__item"><a href="https://www.instagram.com" class="instagram"></a></li>
                        </ul>
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
@import "resources/sass/variables";
.footer {
    padding-top: 48px;
    padding-bottom: 92px;
    .title_contact, .title_menu {
        padding-left: 15px;
        padding-right: 15px;
    }
    .background_line {
        margin-bottom: 30px;
    }
    .footer_link {
        text-decoration: none;
        color: #9B9B9B;
        &:hover {
            color: $designColorOne;
        }
    }
}
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
.icon_social {
    display: flex;
}
.icon_social__item {
    padding-right: 15px;
    &:last-child {
        padding-right: 0;
    }
}
.icon_social a {
    background: #D8D8D8;
    mask-position: center;
    display: block;
    width: 26px;
    height: 26px;
    transition: 0.2s;

    &:hover, &:active {
        background: $designColorOne;
    }
}

.facebook {
    mask-image: url("../../images/icons/ic_facebook.svg");

}

.instagram {
    mask-image: url("../../images/icons/ic_instagram.svg");

}

.twitter {
    mask-image: url("../../images/icons/ic_twitter.svg");
}

</style>
