<template>
    <div class="profile">
        <div class="profile_title">Мой профиль</div>
        <div class="profile_form">
            <div class="inform_title">Общая информация</div>
            <form action="">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <div class="profile_photo"><img src="images/placeholder.png" alt=""></div>
                            <label>Фамилия:</label>
                            <input type="text" class="form-control">

                            <label>Имя:</label>
                            <input type="text" class="form-control">

                            <label>Отчество:</label>
                            <input type="text" class="form-control">

                            <label>Имя</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-6">
                            <label>Дата рождения:</label>
                            <input type="date" class="form-control">

                            <label>Отдел:</label>
                            <select class="form-control">
                                <option value="">Отдел разработки проектов</option>
                            </select>

                            <label>Должность:</label>
                            <input type="text"  class="form-control">

                            <label>Дата начала работы:</label>
                            <input type="datetime-local"  class="form-control">
                        </div>
                    </div>
                    <div class="inform_title">Контактная информация</div>
                    <div class="row">
                        <div class="col-6">
                            <label>E-mail</label>
                            <input type="text" class="form-control">

                            <label>Skype:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-6">
                            <label>Мобильный телефон:</label>
                            <input type="tel" class="form-control">

                            <label>Рабочий телефон:</label>
                            <input type="tel"  class="form-control">
                        </div>
                    </div>
                    <div class="form_button">
                        <button class="btn btn-primary">СОХРАНИТЬ</button>
                        <button class="btn cancel_btn">ОТМЕНИТЬ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "Profile"
}
</script>

<style scoped>

</style>
