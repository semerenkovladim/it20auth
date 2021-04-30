<template>
    <div class="user_edit_form col-12">
        <form action="#" method="post" class="row user_edit_form__form">
            <div class="col-12 edit_form__title">Общая информация</div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="label_wrapper">
                            <label class="edit_form__label img_input_label">
                                <input type="file" accept="image/*" class="d-none">
<!--                                <img src="#" :alt="userData.lastName + ' ' + userData.firstName + ' фото'">-->
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="edit_form__label">
                            <span class="input_title">Дата рождения:</span>
                            <input type="date" class="styled"
                                   v-model="userData.dateOfBirth">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="edit_form__label">
                    <span class="input_title">Фамилия:</span>
                    <input type="text" class="styled"
                           v-model="userData.lastName">
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Имя:</span>
                    <input type="text" class="styled"
                           v-model="userData.firstName">
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Отчество:</span>
                    <input type="text" class="styled"
                           v-model="userData.patronymic">
                </label>
            </div>
            <div class="col-md-6">
                <label class="edit_form__label">
                    <span class="input_title">Отдел:</span>
                    <select name="department" class="styled">
                        <option :value="userData.department">{{ userData.department }}</option>
                        <option value="...">...</option>
                    </select>
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Должность:</span>
                    <select name="position" class="styled">
                        <option :value="userData.position ">{{ userData.position }}</option>
                        <option value="...">...</option>
                    </select>
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Дата начала работы:</span>
                    <input type="date" class="styled"
                           v-model="userData.dateOfCommencementOfWork">
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
                                   @click="userData.admin = true"
                                   :checked="userData.admin">
                        </label>
                        <label class="edit_form__label radio_label">
                            <span class="input_title">Нет</span>
                            <input type="radio"
                                   name="admin_perm"
                                   value="true"
                                   class="input_checkbox"
                                   @click="userData.admin = false"
                                   :checked="!userData.admin">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-12 edit_form__title">Контактная информация</div>
            <div class="col-md-6">
                <label class="edit_form__label">
                    <span class="input_title">E-mail</span>
                    <input type="email" class="styled"
                           v-model="userData.email">
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Skype:</span>
                    <input type="text" class="styled"
                           v-model="userData.skype">
                </label>
            </div>
            <div class="col-md-6">
                <label class="edit_form__label">
                    <span class="input_title">Мобильный телефон:</span>
                    <input type="tel" class="styled"
                           v-model="userData.phone">
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Рабочий телефон:</span>
                    <input type="tel" class="styled"
                           v-model="userData.wPhone">
                </label>
            </div>
            <div class="col-12">
                <div class="btn_wrapper">
                    <ConfirmBtn :text="confirm"></ConfirmBtn>
                    <CancelBtn></CancelBtn>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import ConfirmBtn from "../../buttons/ConfirmBtn";
import CancelBtn from "../../buttons/CancelBtn";

export default {
    name: "UserEditForm",
    props: ['data'],
    components: {
        CancelBtn,
        ConfirmBtn
    },
    data() {
        return {
            confirm: 'Сохранить',
            userData: {
                img: this.data.img,
                firstName: this.data.firstName,
                lastName: this.data.lastName,
                patronymic: this.data.patronymic,
                dateOfBirth: this.data.dateOfBirth,
                department: this.data.department,
                position: this.data.position,
                dateOfCommencementOfWork: this.data.dateOfCommencementOfWork,
                admin: this.data.admin,
                email: this.data.email,
                phone: this.data.phone,
                wPhone: this.data.wPhone,
                skype: this.data.skype
            }
        }
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
        background: url('../../../../images/users_img/user_demo_img.png') no-repeat center / cover;

        img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            //object-fit: cover;

        }

        img[alt] {
            font-size: 12px;
            padding-top: 40%;
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
            // background: url('../../../../images/icons/date_icon.png') no-repeat center;
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
