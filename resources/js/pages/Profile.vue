<template>
    <div class="profile">
        <div class="profile_title">Мой профиль</div>
        <div class="profile_form">
            <MessagePopup
                :popup-message="popupMessage"
                :popup-show="popupShow"
                @closePopup="popupShow = false">
            </MessagePopup>
            <Message @confirmEvent="cancelUser(user)"></Message>
            <div class="inform_title">Общая информация</div>
            <div class="col-12 error-message"
                 v-if="message.status">{{ message.text }}
            </div>
            <form action="#"
                  method="post"
                  class="row user_edit_form__form"
                  enctype="multipart/form-data">
                <div class="container">
                    <div class="row profile_input">
                        <div class="col-6">
                            <div class="label_wrapper">
                                <label class="edit_form__label img_input_label" @click="showComponent = !showComponent">
                                    <div class="cropper-wrapper" v-if="showComponent" @click.stop>
                                        <VueCropper
                                            @closeCropper="showComponent = false"
                                            @uploadSuccess="setCropImg">
                                        </VueCropper>
                                    </div>
                                    <img :src="user.avatar"
                                         :alt="user.surname + ' ' + user.name + ' фото'"
                                         v-if="user.avatar"
                                         v-cloak>
                                    <span class="short-fio" v-else>{{
                                            shortFio(user.surname, user.name)
                                        }}</span>
                                </label>
                            </div>
                            <label class="required_field">Фамилия:</label>
                            <input type="text" class="form-control" v-model="user.surname" maxlength="100">

                            <label class="required_field">Имя:</label>
                            <input type="text" class="form-control" v-model="user.name" maxlength="100">

                            <label>Отчество:</label>
                            <input type="text" class="form-control" v-model="user.middle_name" maxlength="100">
                        </div>
                        <div class="col-6 row_date">
                            <label class="required_field">Дата рождения:</label>
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
                                <span class="input_title required_field">Должность:</span>
                                <input type="text" class="form-control" v-model="user.position">
                            </label>
                            <label>Дата начала работы:</label>
                            <input type="date" class="form-control" v-model="user.date_start">
                        </div>
                    </div>
                    <div class="inform_title">Контактная информация</div>
                    <div class="row profile_input">
                        <div class="col-6">
                            <label class="required_field">E-mail</label>
                            <input type="text" class="form-control" v-model="user.email" maxlength="255"
                                   required>

                            <label>Skype:</label>
                            <input type="text" class="form-control" v-model="user.skype" maxlength="255">
                        </div>
                        <div class="col-6">
                            <label>Мобильный телефон:</label>
                            <input type="tel" class="form-control" v-model="user.mobile_phone" maxlength="12"
                                   minlength="10">

                            <label>Рабочий телефон:</label>
                            <input type="tel" class="form-control" v-model="user.work_phone" maxlength="12"
                                   minlength="10">
                        </div>
                    </div>
                    <div class="form_button">
                        <ConfirmBtn :text="confirm"
                                    @confirmEvent="updateProfile(user)" :btnDisabled="confirmDisabled">
                        </ConfirmBtn>
                        <CancelBtn @cancelEvent="cancelUser(user)"></CancelBtn>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";
import ConfirmBtn from "../components/buttons/ConfirmBtn";
import CancelBtn from "../components/buttons/CancelBtn";
import VueCropper from "../components/vue-image-crop/VueCropper";
import Message from "../components/message/Message";
import MessagePopup from "../components/message-popup/MessagePopup";

export default {
    components: {
        ConfirmBtn,
        CancelBtn,
        VueCropper,
        Message,
        MessagePopup
    },
    data() {
        return {
            confirm: 'Сохранить',
            popupMessage: '',
            confirmDisabled: false,
            popupShow: false,
            showComponent: false,
            imgChange: false,
            user: {
                surname: '',
                name: '',
                middle_name: '',
                avatar: '',
                birth: '',
                date_start: '',
                email: '',
                mobile_phone: '',
                work_phone: '',
                skype: '',
                department_id: ''
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
            message: {
                status: false,
                text: 'Заполните, пожалуйста, все обязательные поля'
            },
            imgData: {}
        }

    },
    methods: {
        ...mapActions([
            'saveUserFromServer',
            'saveAccessFromServer',
            'saveRefreshFromServer',
            'getUMMessage'
        ]),
        setCropImg(data) {
            this.user.avatar = data.path
        },
        imgSelected(data) {
            this.imgData = data
        },
        checkFields() {
            let fields = document.querySelectorAll('.required_field > [required]')
            for (let input of fields) {
                if (input.value.trim().length < 1) {
                    input.classList.add('form-control')
                    setTimeout(function () {
                        input.classList.remove('empty_field')
                    }, 1500)
                } else {
                    input.classList.remove('empty_field')

                }
            }
        },
        /*handleFileUpload(data) {
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
        },*/
        shortFio(last, first) {
            if (last && first) return last.slice(0, 1) + '.' + first.slice(0, 1)
        },
        updateProfile(data) {
            this.checkFields()
            this.confirmDisabled = true
            console.log('data', data)
            return axios.put('/api/user/update',  data)
                .then(value => {
                    console.log('updateProfile', value)
                    if (value.data.status) {
                        this.message.status = false
                        this.popupShow = true
                        this.popupMessage = "Изменения успешно сохранены"
                    } else {
                        this.message.status = true
                        this.message.text = value.data.error
                    }
                    this.confirmDisabled = false
                    window.scrollTo(0, 0)
                })
                .catch(reason => {
                    this.message.status = true
                    this.message.text = 'Ошибка'
                    this.confirmDisabled = false
                })
        },
        cancelUser(data) {
            let back = true
            for (let key of Object.keys(data)) {
                if (data[key] !== '') {
                    data[key] = ''
                    back = false
                }
            }
            if (back) {
                this.$router.push('/profile')
            }
        }
    },
    mounted() {
        this.user = Object.assign(this.user, this.auth_user)
        console.log('User', this.user)
    },
    computed: {
        auth_user() {
            return this.$store.getters.user;
        }
    }
}
</script>
<style lang="scss">
[disabled] {
    opacity: 0.5;
}
</style>
