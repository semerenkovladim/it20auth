<template>
        <div class="profile">
            <div class="profile_title">Мой профиль</div>
            <div class="profile_form">
                <div class="inform_title">Общая информация</div>
                <form action="#"
                    method="post"
                    class="row user_edit_form__form"
                    enctype="multipart/form-data">
                    <div class="container">
                        <div class="row profile_input">
                            <div class="col-6">
                                <div class="profile_photo"><img src="../../images/placeholder.png" alt=""></div>
                                    <label>Фамилия:</label>
                                    <input type="text" class="form-control">

                                    <label>Имя:</label>
                                    <input type="text" class="form-control" v-model="user.name">

                                    <label>Отчество:</label>
                                    <input type="text" class="form-control" v-model="user.middle_name">
                            </div>
                    <div class="col-6 row_date">
                        <label>Дата рождения:</label>
                        <input type="date" class="form-control" v-model="user.birth">

                        <label>Отдел:</label>
                        <select class="form-control" v-model="user.departament_id">
                            <option value="">Отдел разработки проектов</option>
                        </select>

                        <label>Должность:</label>
                        <input type="text"  class="form-control" v-model="user.position">

                        <label>Дата начала работы:</label>
                        <input type="datetime-local"  class="form-control" v-model="user.date_start">
                    </div>
                </div>
                <div class="inform_title">Контактная информация</div>
                <div class="row profile_input">
                    <div class="col-6">
                        <label>E-mail</label>
                        <input type="text" class="form-control" v-model="user.email">

                        <label>Skype:</label>
                        <input type="text" class="form-control" v-model="user.skype">
                    </div>
                    <div class="col-6">
                        <label>Мобильный телефон:</label>
                        <input type="tel" class="form-control" v-model="user.mobile_phone">

                        <label>Рабочий телефон:</label>
                        <input type="tel"  class="form-control" v-model="user.work_phone">
                    </div>
                </div>
                <div class="form_button">
                    <button class="btn btn-primary save_btn">СОХРАНИТЬ</button>
                    <button class="btn cancel_btn">ОТМЕНИТЬ</button>
                </div>
            </div>
        </form>
    </div>
</div>
</template>

<script>
import {mapActions} from "vuex";
    export default {
    data() {
        return{
            user: {
                position:null,
                name:null,
                surname:null,
                middle_name:null,
                avatar:null,
                birth:null,
                date_start:null,
                email:null,
                mobile_phone:null,
                work_phone:null,
                skype:null,
                department_id:null,
                password:null,
                code:null
            },
                errors: []
        }
    },
    methods: {
        ...mapActions([
            'saveUserFromServer',
            'saveAccessFromServer',
            'saveRefreshFromServer'
        ])
    },
    created(){
        axios.get("/api/profile").then(response => (this.user = response))
        }
    }
</script>
