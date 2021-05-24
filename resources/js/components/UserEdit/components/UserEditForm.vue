<template>
    <div class="user_edit_form col-12">
        <MessagePopup
            :popup-message="popupMessage"
            :popup-show="popupShow"
            @closePopup="toManagement">
        </MessagePopup>
        <Message @confirmEvent="cancelUser(userData)"></Message>
        <form action="#"
              method="post"
              class="row user_edit_form__form"
              enctype="multipart/form-data">
            <div class="col-12 edit_form__title">Общая информация</div>
            <div class="col-12 error-message"
                 v-if="message.status">{{ message.text }}
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="label_wrapper">
                            <div class="edit_form__label img_input_label" @click="showComponent = !showComponent">
                                <div class="cropper-wrapper" v-if="showComponent" @click.stop>
                                    <VueCropper
                                        @closeCropper="showComponent = false"
                                        @uploadSuccess="setCropImg">
                                    </VueCropper>
                                </div>
                                <img :src="userData.data.avatar"
                                     :alt="userData.data.surname + ' ' + userData.data.name + ' фото'"
                                     v-if="userData.data.avatar"
                                     v-cloak>
                                <span class="short-fio" v-else>{{
                                        shortFio(userData.data.surname, userData.data.name)
                                    }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="edit_form__label required_field">
                            <span class="input_title">Дата рождения:</span>
                            <input type="date" class="styled"
                                   v-model="userData.data.birth"
                                   min="1920-01-01"
                                   :max="currentDate"
                                   required
                                   tabindex="1">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="edit_form__label required_field">
                    <span class="input_title">Фамилия:</span>
                    <input type="text" class="styled"
                           v-model="userData.data.surname"
                           maxlength="100"
                           required
                           tabindex="2">
                </label>
                <label class="edit_form__label required_field">
                    <span class="input_title">Имя:</span>
                    <input type="text" class="styled"
                           v-model="userData.data.name"
                           maxlength="100"
                           required
                           tabindex="3">
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Отчество:</span>
                    <input type="text" class="styled"
                           v-model="userData.data.middle_name"
                           maxlength="100"
                           tabindex="4">
                </label>
            </div>
            <div class="col-md-6">
                <label class="edit_form__label">
                    <span class="input_title">Отдел:</span>
                    <span class="select-wrapper">
                        <select name="department"
                                class="styled"
                                v-model="userData.data.department_id"
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
                <label class="edit_form__label required_field">
                    <span class="input_title">Должность:</span>
                    <input type="text" class="styled"
                           v-model="userData.data.position"
                           required>
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Дата начала работы:</span>
                    <input type="date"
                           class="styled"
                           min="2018-01-01"
                           :max="currentDate"
                           v-model="userData.data.date_start"
                           tabindex="7">
                </label>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input_title">Доступ администратора:</div>
                    </div>
                    <div class="col-md-6 radio_col">
                        <label class="edit_form__label radio_label">
                            <span class="input_title">Да</span>
                            <input type="radio"
                                   name="admin_perm"
                                   value="false"
                                   class="input_checkbox"
                                   @click="userData.data.is_admin = true"
                                   :checked="userData.data.is_admin">
                        </label>
                        <label class="edit_form__label radio_label">
                            <span class="input_title">Нет</span>
                            <input type="radio"
                                   name="admin_perm"
                                   value="true"
                                   class="input_checkbox"
                                   @click="userData.data.is_admin = false"
                                   :checked="!userData.data.is_admin">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-12 edit_form__title">Контактная информация</div>
            <div class="col-md-6">
                <label class="edit_form__label required_field">
                    <span class="input_title">E-mail</span>
                    <input type="email" class="styled"
                           v-model="userData.data.email"
                           maxlength="255"
                           required
                           tabindex="8">
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Skype:</span>
                    <input type="text" class="styled"
                           v-model="userData.data.skype"
                           maxlength="255"
                           tabindex="9">
                </label>
            </div>
            <div class="col-md-6">
                <label class="edit_form__label">
                    <span class="input_title">Мобильный телефон:</span>
                    <input type="tel" class="styled"
                           v-model="userData.data.mobile_phone"
                           maxlength="12"
                           minlength="10"
                           tabindex="10">
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Рабочий телефон:</span>
                    <input type="tel" class="styled"
                           v-model="userData.data.work_phone"
                           maxlength="12"
                           minlength="10"
                           tabindex="11">
                </label>
            </div>
            <div class="col-12">
                <div class="btn_wrapper" v-if="$route.path === '/users-management/user-edit'">
                    <ConfirmBtn :text="confirm2"
                                @confirmEvent="updateUser(userData)"
                                :btnDisabled="confirmDisabled">
                    </ConfirmBtn>
                    <CancelBtn @cancelEvent="$router.push('/users-management')"></CancelBtn>
                </div>
                <div class="btn_wrapper" v-if="$route.path === '/users-management/new-user'">
                    <ConfirmBtn :text="confirm"
                                @confirmEvent="createUser(userData)"
                                :btnDisabled="confirmDisabled">
                    </ConfirmBtn>
                    <CancelBtn @cancelEvent="cancelUser(userData)"></CancelBtn>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import ConfirmBtn from "../../buttons/ConfirmBtn";
import CancelBtn from "../../buttons/CancelBtn";
import Message from "../../message/Message";
import VueCropper from "../../vue-image-crop/VueCropper";
import MessagePopup from "../../message-popup/MessagePopup";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "UserEditForm",
    props: ['data'],
    components: {
        CancelBtn,
        ConfirmBtn,
        Message,
        VueCropper,
        MessagePopup

    },
    data() {
        return {
            confirmDisabled: false,
            popupMessage: '',
            popupShow: false,
            showComponent: false,
            confirm: 'Сохранить',
            confirm2: 'Изменить',
            imgChange: false,
            currentDate: '',
            userData: {
                data: {
                    is_admin: false
                },
                access_levels: {
                    account: 0,
                    disk: 0,
                    mail: 0,
                    contacts: 0,
                    photo: 0,
                    calendar: 0
                }
            },
            oldData: {

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
                    id: 1,
                    title: 'Дизайнер'
                },
                {
                    id: 2,
                    title: 'Разработчик'
                },
                {
                    id: 3,
                    title: 'Менеджер'
                }
            ],
            userId: 0,
            routeBack: false,
            message: {
                status: false,
                text: 'Заполните, пожалуйста, все обязательные поля'
            },
            imgData: {}
        }
    },
    methods: {
        ...mapActions([
            'getUMMessage',
            'getAllDepartments',
            'changeUMPersonalDataStatus',
            'getProfile'

        ]),
        toManagement() {
            if (this.$route.path === '/users-management/new-user') {
                this.$router.push('/users-management')
            } else {
                this.popupShow = false
            }
        },
        setCropImg(data) {
            this.userData.data.avatar = data.path
        },
        imgSelected(data) {
            this.imgData = data
        },
        checkFields() {
            let fields = document.querySelectorAll('.required_field > [required]')
            for (let input of fields) {
                if (input.value.trim().length < 1) {
                    input.classList.add('empty_field')
                } else {
                    input.classList.remove('empty_field')

                }
            }
        },
        createUser(data) {
            this.checkFields()
            this.confirmDisabled = true
            return axios.post('/api/user/create', data.data)
                .then(value => {
                    if (value.data.status) {
                        this.message.status = false
                        this.userId = value.data.data.id
                        axios.post('/api/user/settings/create', {
                            user_id: value.data.data.id
                        })
                        this.popupShow = true
                        this.popupMessage = "Данные успешно сохранены"
                        this.cancelUser(this.userData)

                    } else {
                        this.confirmDisabled = true
                        this.message.status = true
                        this.message.text = value.data.error
                    }
                    this.confirmDisabled = false
                    window.scrollTo(0, 0)
                })

        },
        updateUser(data) {
            this.checkFields()
            this.confirmDisabled = true
            return axios.put('/api/user/update', data.data)
                .then(value => {
                    if (value.data.status) {
                        console.log('value.data.data id', value.data.data.id)
                        this.message.status = false
                        this.popupShow = true
                        this.popupMessage = "Изменения успешно сохранены"
                        if (value.data.data.id === this.auth_user.id) {
                            this.getProfile(this.auth_user.id)
                        }
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
            for (let key of Object.keys(data.data)) {
                if (data.data[key] !== '') {
                    data.data[key] = ''
                    back = false
                }
            }
            if (back) {
                this.$router.push('/users-management')
            }
        },
        shortFio(last, first) {
            if (last && first) return last.slice(0, 1) + ' ' + first.slice(0, 1)

        },
        setData() {
            this.userData.data = this.data
        },
        setCurrentDate() {
            let date = new Date(),
                year = date.getFullYear(),
                month,
                day
            date.getMonth() < 10 ? month = '0' + (date.getMonth() + 1) : month = date.getMonth() + 1
            date.getDate() < 10 ? day = '0' + date.getDate() : day = date.getDate()
            this.currentDate = `${year}-${month}-${day}`

        },
        arraysEqual(arr1, arr2) {
            if (arr1.length !== arr2.length)
                return false;
            for (var i = arr1.length; i--;) {
                if (arr1[i] !== arr2[i])
                    return false;
            }
            return true;
        }
    },
    computed: {
        ...mapGetters([
            'ALL_DEPARTMENTS'
        ]),
        setUserData() {
            return this.data
        },
        auth_user() {
            return this.$store.getters.user;
        },
        checkUserData() {
            return Object.values(this.userData.data)
        }
    },
    watch: {
        setUserData() {
            this.setData()
        },
        // checkUserData() {
        //     this.arraysEqual(Object.values(this.userData.data), Object.values(this.data)) ? this.confirmDisabled = true : this.confirmDisabled = false
        //     console.log('userData', Object.values(this.userData.data))
        //     console.log('data', Object.values(this.data))
        //     console.log('arraysEqual', this.arraysEqual(Object.values(this.userData.data), Object.values(this.data)) ? this.confirmDisabled = true : this.confirmDisabled = false)
        // }
    },
    mounted() {
        this.setData()
        this.setCurrentDate()
        this.getAllDepartments()
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";

[disabled] {
    opacity: 0.5;
}

.user_edit_form {
    background: #FFFFFF;
    max-width: 900px;
    margin: 0 auto;
    padding-bottom: 30px;


    .select-wrapper {
        width: 100%;
    }

    .cropper-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
    }

    .edit_form__label {
        flex-direction: column;
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;

        .styled {
            padding: 0 25px;
            display: flex;
            align-items: center;
            min-height: 60px;
            width: 100%;
            background: #FFFFFF;
            border: 2px solid #F5F5F5;
            border-radius: 4px;
            font-style: normal;
            font-weight: bold;
            font-size: 14px;
            color: #808080;
            margin-bottom: 10px;

            &:focus {
                border: 2px solid darken(#F5F5F5, 10%);
            }
        }

        input[type=date] {
            transition: 0.2s;

            &::-webkit-calendar-picker-indicator {
                transition: 0.2s ease;
                color: transparent;
                opacity: 1;
                background: url('../../../../images/icons/ic_today.png') no-repeat center;
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

        .empty_field {
            border: 2px solid #FF0000;
        }
    }

    .radio_col {
        display: flex;
        align-items: center;
    }

    .input_title {
        font-weight: 500;
        font-size: 14px;
        color: $darkColor;
        display: flex;
        min-height: 30px;
        align-items: center;
        justify-content: flex-start;
        width: 100%;
        margin-bottom: 10px;

    }

    .radio_label {
        max-width: 95px;
        width: 100%;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;

        .input_title {
            width: fit-content;
            padding-right: 15px;
            margin-bottom: 0;
        }
    }

    .short-fio {
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        width: 100%;
        height: 100%;
        flex: 1 1 100%;
        justify-content: center;
        align-items: center;
        font-weight: 600;
        color: #FFFFFF;
        font-size: 42px;
        text-transform: uppercase;
        transition: none;

        &:hover {
            color: transparent;
            opacity: 0;
        }
    }

    .btn_wrapper {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .label_wrapper {
        width: 100%;
        max-width: 132px;
        margin: auto;
    }

    .img_input_label {
        border: 0.5px solid #666666;
        box-sizing: border-box;
        border-radius: 100px;
        width: 100%;
        padding-top: 100%;
        position: relative;
        overflow: hidden;
        transition: none;
        background: rgba(76, 75, 75, 0.5);
        cursor: pointer;

        &:hover {
            &:after {
                top: 0;
                left: 0;
                position: absolute;
                content: '';
                display: block;
                width: 100%;
                height: 100%;
                background: url("../../../../images/icons/ic_camera_alt.png") no-repeat center / 30%, darken(rgba(76, 75, 75, 0.6), 15%);
            }
        }

        img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;

        }

        img[alt] {
            font-size: 12px;
            text-align: center;
        }
    }
}

.edit_form__title {
    font-weight: 500;
    font-size: 18px;
    color: $lightColor;
    min-height: 87px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-bottom: 2px solid #F5F5F5;;
    margin-bottom: 15px;

}

.error-message {
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    text-align: center;
    color: #FF0000;
    margin-bottom: 15px;

}


.required_field {
    .input_title {
        position: relative;
        width: fit-content;

        &:before {
            position: absolute;
            top: 2px;
            right: -8px;
            content: '*';
            color: red;
            display: block;
        }
    }
}


</style>
