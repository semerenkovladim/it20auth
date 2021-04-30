<template>
  <div id="app">
      <div>
           <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-interval="30000">
                    <img src="images/01.png" class="d-block w-100" alt="slide1">
                    </div>
                    <div class="carousel-item" data-interval="30000">
                    <img src="images/02.png" class="d-block w-100" alt="slide1">
                    </div>
                    <div class="carousel-item" data-interval="30000">
                    <img src="images/03.png" class="d-block w-100" alt="slide1">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="container title_hello">
                <div class="title">Рады снова Вас приветствовать!</div>
                <div class="hello_description">
                    Пожалуйста, обратите внимание на новый функционал:
                </div>
            </div>
      </div>
<div class="cards">
    <div class="row">

        <div class="card mb-3 hello contact_item">
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

        <div class=" card mb-3 a hello contact_item">
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
                    Используйте инструмент Mail для внутреннего комфортного общения среди сотрудников компании.
                  </div>
                  <div class="card-text">Без ограничения на количество писем.</div>
                </div>
              </div>
            </div>
        </div>

        <div class="card mb-3 a hello contact_item">
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
                    Используйте удобный инструмент Calendar для фиксации важных событий, встреч и рабочих мероприятий.
                  </div>
                  <div class="card-text">Оцените интуитивно понятный интерфейс и локаничный дизайн.</div>
                </div>
              </div>
            </div>
        </div>

        <div class="card mb-3 a hello contact_item">
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
                    Публикуйте все знаменательные события из жизни компании в личное пространство Photos.
                  </div>
                  <div class="card-text">Формируйте папки и вложенность как удобно Вам.</div>
                </div>
              </div>
            </div>
        </div>
        <div class="card mb-3 a hello contact_item">
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
                    Добавляйте важные номера телефонов, адреса электронных почт, никнеймы различных мессенджеров в одно место Contacts.
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
export default {
  components: {},
  data() {
    return {};
  },
};
</script>
<style>
</style>
