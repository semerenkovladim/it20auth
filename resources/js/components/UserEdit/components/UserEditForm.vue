<template>
    <div class="user_edit_form col-12">
        <Message @confirmEvent="cancelUser(userData)"></Message>
        <form action="#"
              method="post"
              class="row user_edit_form__form"
              enctype="multipart/form-data">
            <div class="col-12 edit_form__title">Общая информация</div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="label_wrapper">
<!--                            <Cropper :imageProp="imgData"-->
<!--                                     @cropImg="setCropImg">-->
<!--                            </Cropper>-->
<!--                            <ImageLoader :imageProp="userData.data.avatar"-->
<!--                                         @imageSelected="imgSelected">-->
<!--                            </ImageLoader>-->
                            <label class="edit_form__label img_input_label">

                                <input type="file"
                                       accept="image/*"
                                       name="image"
                                       ref="file"
                                       class="d-none"
                                       @change="handleFileUpload(userData)">
                                <img :src="userData.data.avatar"
                                     :alt="userData.data.surname + ' ' + userData.data.name + ' фото'"
                                     v-if="userData.data.avatar">
                                <span class="short-fio" v-else>{{
                                        shortFio(userData.data.surname, userData.data.name)
                                    }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="edit_form__label">
                            <span class="input_title">Дата рождения:</span>
                            <input type="date" class="styled"
                                   v-model="userData.data.birth"
                                   required>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="edit_form__label">
                    <span class="input_title">Фамилия:</span>
                    <input type="text" class="styled"
                           v-model="userData.data.surname"
                           maxlength="100">
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Имя:</span>
                    <input type="text" class="styled"
                           v-model="userData.data.name"
                           maxlength="100">
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Отчество:</span>
                    <input type="text" class="styled"
                           v-model="userData.data.middle_name"
                           maxlength="100">
                </label>
            </div>
            <div class="col-md-6">
                <label class="edit_form__label">
                    <span class="input_title">Отдел:</span>
                    <select name="department" class="styled" v-model="userData.data.department_id">
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
                            v-model="userData.data.position"
                            required>
                        <option v-for="position in positions"
                                :key="position.id"
                                :value="position.id">
                            {{ position.title }}
                        </option>
                    </select>
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Дата начала работы:</span>
                    <input type="date" class="styled"
                           v-model="userData.data.date_start">
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
                <label class="edit_form__label">
                    <span class="input_title">E-mail</span>
                    <input type="email" class="styled"
                           v-model="userData.data.email"
                           maxlength="255"
                           required>
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Skype:</span>
                    <input type="text" class="styled"
                           v-model="userData.data.skype"
                           maxlength="255"
                    >
                </label>
            </div>
            <div class="col-md-6">
                <label class="edit_form__label">
                    <span class="input_title">Мобильный телефон:</span>
                    <input type="tel" class="styled"
                           v-model="userData.data.mobile_phone"
                           maxlength="12"
                           minlength="10">
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Рабочий телефон:</span>
                    <input type="tel" class="styled"
                           v-model="userData.data.work_phone"
                           maxlength="12"
                           minlength="10">
                </label>
            </div>
            <div class="col-12">
                <div class="btn_wrapper" v-if="$route.path === '/users-management/user-edit'">
                    <ConfirmBtn :text="confirm2"
                                @confirmEvent="updateUser(userData)">
                    </ConfirmBtn>
                    <CancelBtn @cancelEvent="$router.push('/users-management')"></CancelBtn>
                </div>
                <div class="btn_wrapper" v-if="$route.path === '/users-management/new-user'">
                    <ConfirmBtn :text="confirm"
                                @confirmEvent="createUser(userData)">
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
import Cropper from "../../cropper/Cropper";
import ImageLoader from "../../cropper/ImageLoader";
import {mapActions} from "vuex";

export default {
    name: "UserEditForm",
    props: ['data'],
    components: {
        CancelBtn,
        ConfirmBtn,
        Message,
        ImageLoader,
        Cropper

    },
    data() {
        return {
            confirm: 'Сохранить',
            confirm2: 'Изменить',
            imgChange: false,
            userData: {
                data: {
                    is_admin: false
                }
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
            imgData: {}
        }
    },
    methods: {
        ...mapActions([
            'getUMMessage'
        ]),
        setCropImg(data) {
            console.log('setCropImg', data)
            this.userData.data = data
            console.log(' this.userData.data', this.userData.data)
        },
        imgSelected(data) {
            console.log('imgSelected', data)
            this.imgData = data
        },
        createUser(data) {
            return axios.post('/api/user/create', data.data)
                .then(value => {
                    this.getUMMessage(value)
                    if (value.data.status) {
                        this.userId = value.data.data.id
                        axios.post('/api/user/permission/create', {
                            user_id: value.data.data.id
                        })
                    }
                })
        },
        updateUser(data) {
            return axios.put('/api/user/update/' + data.id, data.data)
                .then(value => {
                    this.getUMMessage(value)
                })
                .catch(reason => {
                    this.getUMMessage('error')
                })
        },
        cancelUser(data) {
            let back = true
            console.log('cancelUser', data, this.routeBack)
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
        handleFileUpload(data) {
            console.log('handleFileUpload', data)
            if (data.data.avatar !== this.$refs.file.files[0] && this.$refs.file.files[0]) {
                this.imgChange = true
                data.data.avatar = this.$refs.file.files[0];
                this.saveImg(data.data.avatar, data)
            }
        },
        saveImg(image, data) {
            let formData = new FormData();
            formData.append('file', image)
            return axios.post('/api/image/upload/avatar', formData)
                .then(value => {
                    data.data.avatar = value.data.path
                })
        },
        shortFio(last, first) {
            if (last && first) return last.slice(0, 1) + '.' + first.slice(0, 1)

        },
        setData() {
            console.log('this.data', this.$props.data)
            this.userData.data = this.data
        },
    },
    computed: {
        setUserData() {
            return this.data
        }
    },
    watch: {
        setUserData() {
            this.setData()
        }
    },
    mounted() {
        this.setData()
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.user_edit_form {
    background: #FFFFFF;
    max-width: 900px;
    margin: 0 auto;
    padding-bottom: 30px;

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

.edit_form__label {
    flex-direction: column;
    display: flex;

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
    }

    input[type=date] {
        &::-webkit-calendar-picker-indicator {
            transition: 0.2s ease;
            color: transparent;
            opacity: 1;
            background: url('../../../../images/icons/ic_today.png') no-repeat center;
            background-size: 26px 26px;
            cursor: pointer;
            padding: 5px 0 5px 5px;

            &:hover {
                transform: translateY(-25%);
            }
        }
    }
}


</style>
