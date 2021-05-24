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
            <div>
                <form action="#"
                      method="post"
                      class="row user_edit_form__form"
                      enctype="multipart/form-data">
                    <div class="col-12">
                        <div class="row profile_input">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6 profile_col">
                                        <div class="label_wrapper">
                                            <div class="edit_form__label img_input_label"
                                                 @click="showComponent = !showComponent">
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 profile_col">
                                        <label class="required_field">
                                            <span class="input_title">Дата рождения:</span>
                                            <input type="date" class="form-control styled" v-model="user.birth"
                                                   required>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 profile_col">
                                <label class="required_field">
                                    <span class="input_title">Фамилия:</span>
                                    <input type="text" class="form-control styled" v-model="user.surname"
                                           maxlength="255"
                                           required>
                                </label>
                                <label class="required_field">
                                    <span class="input_title">Имя:</span>
                                    <input type="text" class="form-control styled" v-model="user.name" maxlength="255"
                                           required>
                                </label>
                                <label>
                                    <span class="input_title">Отчество:</span>
                                    <input type="text" class="form-control styled" v-model="user.middle_name"
                                           maxlength="255">
                                </label>
                            </div>
                            <div class="col-md-6 row_date profile_col">
                                <label class="edit_form__label">
                                    <span class="input_title">Отдел:</span>
                                    <span class="select-wrapper">
                                        <select name="department"
                                                class="styled"
                                                v-model="user.department_id"
                                                tabindex="5">
                                        <option v-for="department in ALL_DEPARTMENTS"
                                                :key="department.id"
                                                :value="department.id"
                                        >
                                            {{ department.title }}
                                        </option>
                                    </select>
                                    </span>
                                </label>
                                <label class="edit_form__label">
                                    <span class="input_title required_field">Должность:</span>
                                    <input type="text" class="form-control styled"
                                           v-model="user.position"
                                           maxlength="255"
                                           required>
                                </label>
                                <label>
                                    <span class="input_title">Дата начала работы:</span>
                                    <input type="date" class="form-control styled" v-model="user.date_start">
                                </label>
                            </div>
                        </div>
                        <div class="inform_title">Контактная информация</div>
                        <div class="row profile_input">
                            <div class="col-md-6 profile_col">
                                <label class="required_field">
                                    <span class="input_title">E-mail</span>
                                    <input type="text" class="form-control styled" v-model="user.email" maxlength="255"
                                           required>
                                </label>
                                <label>
                                    <span class="input_title">Skype:</span>
                                    <input type="text" class="form-control styled" v-model="user.skype" maxlength="255">
                                </label>
                            </div>
                            <div class="col-md-6 profile_col">
                                <label>
                                    <span class="input_title">Мобильный телефон:</span>
                                    <input type="tel" class="form-control styled" v-model="user.mobile_phone"
                                           maxlength="12"
                                           minlength="10">
                                </label>

                                <label>
                                    <span class="input_title">Рабочий телефон:</span>
                                    <input type="tel" class="form-control styled" v-model="user.work_phone"
                                           maxlength="12"
                                           minlength="10">
                                </label>
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
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
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
                department_id: '',

            },
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
            'getUMMessage',
            'getAllDepartments',
            'getProfile'
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
            return axios.put('/api/user/update', data)
                .then(value => {
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
                this.$router.go()
            }
        }
    },
    async mounted() {
        await this.getProfile(this.auth_user.id)
        this.user = Object.assign(this.user, this.auth_user)
        console.log('User', this.user)
        this.getAllDepartments()

    },
    computed: {
        auth_user() {
            return this.$store.getters.user;
        },
        ...mapGetters([
            'ALL_DEPARTMENTS'
        ])
    }
}
</script>
<style lang="scss">
@import "resources/sass/variables";

[disabled] {
    opacity: 0.5;
}

.edit_form__title {
    font-weight: 500;
    font-size: 18px;
    min-height: 87px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-bottom: 2px solid #F5F5F5;;
    margin-bottom: 15px;

}

.input_title {
    font-weight: 500;
    font-size: 14px;
    display: flex;
    min-height: 30px;
    align-items: center;
    justify-content: flex-start;
    width: 100%;
    margin-bottom: 7px;
}

.styled {
    padding: 0 25px;
    display: flex;
    align-items: center;
    min-height: 60px;
    width: 100%;
    background: #FFFFFF;
    border-radius: 4px;
    margin-bottom: 10px;
    border: 2px solid #F5F5F5;
    box-sizing: border-box;
    font-style: normal;
    font-weight: bold;
    font-size: 14px;
    line-height: 60px;
    color: #808080;
}

.profile {
    .form_button {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-control:focus {
        color: #808080;
        background-color: #fff;
        outline: 0;
        box-shadow: none;
        border: 2px solid darken(#F5F5F5, 10%);

    }

    input[type=date] {
        transition: 0.2s;

        &::-webkit-calendar-picker-indicator {
            transition: 0.2s ease;
            color: transparent;
            opacity: 1;
            background: url('../../images/icons/ic_today.png') no-repeat center;
            background-size: 26px 26px;
            cursor: pointer;
            padding: 5px 0 5px 5px;
        }

        &::-webkit-datetime-edit-day-field:focus,
        &::-webkit-datetime-edit-month-field:focus,
        &::-webkit-datetime-edit-year-field:focus {
            background-color: transparent;
            color: $designColorOne;
            font-weight: 900;
            font-size: 18px;
        }
    }
}

.profile_form {
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    border-radius: 6px;
}

.profile_col {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
}

.user_edit_form__form {
    max-width: 1236px;
    margin-left: auto;
    margin-right: auto;
}
</style>
