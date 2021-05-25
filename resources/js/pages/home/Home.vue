<template>
    <div class="row home_page">
        <div class="slider">
            <carousel :autoplay="true" :items="1" :dots="false" :autoplayTimeout="30000" :nav="false">
                <div class="slide slide1"></div>
                <div class="slide slide2"></div>
                <div class="slide slide3"></div>
            </carousel>
        </div>
        <div class="container home_page__container">
            <div class="row">
                <div class="col">
                    <div class="title_hello">
                        <div class="title">Рады снова Вас приветствовать!</div>
                        <div class="hello_description">
                            Пожалуйста, обратите внимание на новый функционал:
                        </div>
                    </div>
                </div>
            </div>
            <div class="row cards__row">
                <div class="card__col">
                    <div class="card hello contact_item">
                        <div class="row g-0">
                            <div class="col-md-4 left_cards">
                                <div class="font_text">D</div>
                                <div class="font_icon icon"></div>
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
                </div>
                <div class="card__col">
                    <div class="card hello contact_item">
                        <div class="row g-0">
                            <div class="col-md-4 left_cards">
                                <div class="font_text">A</div>
                                <div class="cup_icon icon"></div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="card-title offers_title">
                                        Ускорьте скорость доставки писем!
                                    </div>
                                    <div class="card-text description">
                                        Используйте инструмент Mail для внутреннего комфортного общения среди
                                        сотрудников
                                        компании.
                                    </div>
                                    <div class="card-text">Без ограничения на количество писем.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card__col">
                    <div class="card hello contact_item">
                        <div class="row g-0">
                            <div class="col-md-4 left_cards">
                                <div class="font_text">S</div>
                                <div class="wallet_icon icon"></div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="card-title offers_title">
                                        Записывайте важные даты!
                                    </div>
                                    <div class="card-text description">
                                        Используйте удобный инструмент Calendar для фиксации важных событий, встреч
                                        и
                                        рабочих мероприятий.
                                    </div>
                                    <div class="card-text">Оцените интуитивно понятный интерфейс и локаничный
                                        дизайн.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card__col">
                    <div class="card hello contact_item">
                        <div class="row g-0">
                            <div class="col-md-4 left_cards">
                                <div class="font_text">B</div>
                                <div class="cup_icon icon"></div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="card-title offers_title">
                                        Делитесь воспоминания с коллегами!
                                    </div>
                                    <div class="card-text description">
                                        Публикуйте все знаменательные события из жизни компании в личное
                                        пространство
                                        Photos.
                                    </div>
                                    <div class="card-text">Формируйте папки и вложенность как удобно Вам.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card__col">
                    <div class="card hello contact_item">
                        <div class="row g-0">
                            <div class="col-md-4 left_cards">
                                <div class="font_text">B</div>
                                <div class="font_icon icon"></div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="offers_title">
                                        Сохраняйте больше контактов!
                                    </div>
                                    <div class="description">
                                        Добавляйте важные номера телефонов, адреса электронных почт, никнеймы
                                        различных
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
@import "resources/sass/variables";

.slider {
    margin: -10px auto 0;
    width: 100%;

    .slide {
        width: 100%;
        background-size: cover;
    }
}

.title_hello {
    box-shadow: $boxShadow;
    border-radius: 6px;
    padding: 45px 15px 30px;
    bottom: 0;
    top: -50px;


    .title {
        padding-bottom: 0;
        margin-bottom: 10px;
        font-weight: 300;
    }
    .hello_description {
        line-height: 1;
    }
    @media all and (max-width: 900px){
        .title {
            font-size: 28px;
        }
        .hello_description {
            font-size: 20px;
        }
    }
    @media all and (max-width: 768px){
        .title {
            font-size: 22px;
        }
        .hello_description {
            font-size: 18px;
        }
    }
    @media all and (max-width: 500px){
        .title {
            font-size: 18px;
        }
        .hello_description {
            font-size: 16px;
        }
    }
}

.cards__row {
    display: flex;
    justify-content: center;
}

.card__col {
    margin: 0;
    padding-left: 15px;
    padding-right: 15px;
    padding-bottom: 30px;
    flex: 1 1 50%;
    max-width: 570px;
    min-width: 450px;
    display: flex;
    @media all and (max-width: 768px) {
        min-width: 400px;
    }
    @media all and (max-width: 500px) {
        min-width: 280px;
    }

}

.card {
    min-height: 240px;
    height: 100%;
    width: 100%;
    margin: 0;
    border: none;
    padding-left: 15px;
    padding-right: 15px;
    box-shadow: none;
    background: transparent;

    .font_text {
        line-height: 1;
    }

    .icon {
        background-position: center;
        top: 50%;
        left: -5px;
        padding: 0;
        margin: 0;
        height: 70px;
        transform: translateY(-50%);
    }

    .left_cards {
        position: relative;
        max-width: 135px;
        @media all and (max-width: 768px) {
            display: none;
        }
    }

    > .row {
        padding-top: 61px;
        padding-left: 10px;
        padding-bottom: 10px;
        justify-content: flex-end;
        background: #fff;
        box-shadow: $boxShadow;
        border-radius: 6px;
        height: 100%;
    }
}

.card-body {
    height: 100%;
    padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
</style>

