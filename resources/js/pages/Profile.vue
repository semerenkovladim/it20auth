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
                           <div class="label_wrapper">
                            <label class="edit_form__label img_input_label">

                                <input type="file"
                                       accept="image/*"
                                       name="image"
                                       ref="file"
                                       class="d-none"
                                       @change="handleFileUpload(user)">
                                <img :src="user.avatar"
                                     :alt="user.surname + ' ' + user.name + ' фото'"
                                     v-if="user.avatar">
                                <span class="short-fio" v-else>{{
                                        shortFio(user.surname, user.name)
                                    }}</span>
                            </label>
                        </div>
                                    <label>Фамилия:</label>
                                    <input type="text" class="form-control" v-model="user.surname">

                                    <label>Имя:</label>
                                    <input type="text" class="form-control" v-model="user.name">

                                    <label>Отчество:</label>
                                    <input type="text" class="form-control" v-model="user.middle_name">
                            </div>
                    <div class="col-6 row_date">
                        <label>Дата рождения:</label>
                        <input type="date" class="form-control" v-model="user.birth">

                    <label class="edit_form__label">
                            <span class="input_title">Отдел:</span>
                            <select name="department" class="styled" v-model="user.department_id">
                                <option v-for="department in departmentsData"
                                        :key="department.id"
                                        :value="department.id">
                                    {{ department.title }}
                                </option>
                            </select>
                    </label>

                    <label class="edit_form__label">
                            <span class="input_title">Должность:</span>
                            <select name="position" class="styled"
                                    v-model="user.position"
                                    required>
                                <option v-for="position in positions"
                                        :key="position.title"
                                        :value="position.title">
                                    {{ position.title }}
                                </option>
                            </select>
                    </label>
                        <label>Дата начала работы:</label>
                        <input type="date"  class="form-control" v-model="user.date_start">
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
            user:{
                surname:'',
                name:'',
                middle_name:'',
                avatar:'',
                birth:'',
                date_start:'',
                email:'',
                mobile_phone:'',
                work_phone:'',
                skype:'',
                department_id:''
            },
            departmentsData: [
                {
                    id: 1,
                    title: 'Отдел сайтов'
                },
                {
                    id: 2,
                    title: 'Отдел разработки проектов'
                },
                {
                    id: 3,
                    title: 'Отдел дизайна'
                }
            ],
            positions: [
                {
                    title: 'Design'
                },
                {
                    title: 'Developer'
                },
                {
                    title: 'Meneger'
                }
            ],
            imgChange: false,
            imgData: {}
        }
    },
    methods: {
        ...mapActions([
            'saveUserFromServer',
            'saveAccessFromServer',
            'saveRefreshFromServer'
        ]),
        handleFileUpload(data) {
            console.log('handleFileUpload', data)
            if (data.avatar !== this.$refs.file.files[0] && this.$refs.file.files[0]) {
                this.imgChange = true
                data.avatar = this.$refs.file.files[0];
                this.saveImg(data.avatar, data)
            }
        },
        saveImg(image, data) {
            let formData = new FormData();
            formData.append('file', image)
            return axios.post('/api/image/upload/avatar', formData)
                .then(value => {
                    data.avatar = value.data.path
                })
        },
        shortFio(last, first) {
            if (last && first) return last.slice(0, 1) + '.' + first.slice(0, 1)
        }
    },
    mounted(){
        this.user=Object.assign(this.user,this.auth_user)
        console.log('mounted', this.user)
    },
    computed:{
        auth_user(){
            console.log(this.$store.getters.user)
            return this.$store.getters.user;
        }
    }
    }
</script>
