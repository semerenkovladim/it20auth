<template>
    <div class="home_page">
        <div class="slider">
            <carousel :autoplay="true" :items="1" :dots="false" :autoplayTimeout="30000" :nav="false">
                <div class="slide slide1"></div>
                <div class="slide slide2"></div>
                <div class="slide slide3"></div>
            </carousel>
        </div>
        <div class="title_hello">
            <div class="title">Рады снова Вас приветствовать!</div>
            <div class="hello_description">
                Пожалуйста, обратите внимание на новый функционал:
            </div>
        </div>

        <div class="cards">
            <div class="row">
                <div class="card hello contact_item">
                    <div class="row g-0">
                        <div class="col-md-4 left_cards">
                            <div class="font_text">D</div>
                            <div class="font_icon"></div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="card-title offers_title">
                                    Храните важные документы на диске!
                                </div>
                                <div class="card-text description">
                                    Ваше хранилище Disk позволяет хранить до 15 ГБ документов,
                                    необходимых для работы
                                </div>
                                <div class="card-text">Занято 12,25 ГБ из 15 ГБ (81%)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card hello contact_item">
                    <div class="row g-0">
                        <div class="col-md-4 left_cards">
                            <div class="font_text">A</div>
                            <div class="cup_icon"></div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="card-title offers_title">
                                    Ускорьте скорость доставки писем!
                                </div>
                                <div class="card-text description">
                                    Используйте инструмент Mail для внутреннего комфортного общения среди сотрудников
                                    компании.
                                </div>
                                <div class="card-text">Без ограничения на количество писем.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card hello contact_item">
                    <div class="row g-0">
                        <div class="col-md-4 left_cards">
                            <div class="font_text">S</div>
                            <div class="wallet_icon"></div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="card-title offers_title">
                                    Записывайте важные даты!
                                </div>
                                <div class="card-text description">
                                    Используйте удобный инструмент Calendar для фиксации важных событий, встреч и
                                    рабочих мероприятий.
                                </div>
                                <div class="card-text">Оцените интуитивно понятный интерфейс и локаничный дизайн.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card hello contact_item">
                    <div class="row g-0">
                        <div class="col-md-4 left_cards">
                            <div class="font_text">B</div>
                            <div class="cup_icon"></div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="card-title offers_title">
                                    Делитесь воспоминания с коллегами!
                                </div>
                                <div class="card-text description">
                                    Публикуйте все знаменательные события из жизни компании в личное пространство
                                    Photos.
                                </div>
                                <div class="card-text">Формируйте папки и вложенность как удобно Вам.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card hello contact_item">
                    <div class="row g-0">
                        <div class="col-md-4 left_cards">
                            <div class="font_text">B</div>
                            <div class="font_icon"></div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="offers_title">
                                    Сохраняйте больше контактов!
                                </div>
                                <div class="description">
                                    Добавляйте важные номера телефонов, адреса электронных почт, никнеймы различных
                                    мессенджеров в одно место Contacts.
                                </div>
                                <div class="card-text">Вперёд за возможностями!</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import carousel from 'vue-owl-carousel2'

export default {
    name: "Home",
    components: {
        carousel
    }
}
</script>

<style lang="scss">
.slider {
    margin: 0 auto;
    width: 100%;

    .slide {
        width: 100%;
        background-size: cover;
    }
}
.card {
    padding-left: 15px;
    padding-right: 15px;
}
</style>

