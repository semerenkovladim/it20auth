<template>
    <div class="user_edit_form user_access col-12">
        <Message></Message>
        <form action="#" method="post" class="row user_edit_form__form">
            <div class="col-12">
                <label class="edit_form__label"
                       v-for="setting in settings"
                       :key="setting.id">
                    <span class="input_title">{{ setting.title }}:</span>
                    <select name="position"
                            class="styled"
                            v-model="setting.status">
                        <option value="0">Запрещен</option>
                        <option value="1">Разрешен</option>
                    </select>
                </label>
                <!--                <label class="edit_form__label">
                                    <span class="input_title">Почта:</span>
                                    <select name="position" class="styled">
                                        <option value="0">{{ userData.email }}</option>
                                        <option value="1">Разрешен</option>
                                    </select>
                                </label>
                                <label class="edit_form__label">
                                    <span class="input_title">Календарь:</span>
                                    <select name="position" class="styled">
                                        <option value="0">{{ userData.calendar }}</option>
                                        <option value="1">Разрешен</option>
                                    </select>
                                </label>
                                <label class="edit_form__label">
                                    <span class="input_title">Фотографии:</span>
                                    <select name="position" class="styled">
                                        <option :value="userData.position ">{{ userData.photo }}</option>
                                        <option value="Разрешен">Разрешен</option>
                                    </select>
                                </label>
                                <label class="edit_form__label">
                                    <span class="input_title">Контакты:</span>
                                    <select name="position" class="styled">
                                        <option :value="userData.position ">{{ userData.contacts }}</option>
                                        <option value="Разрешен">Разрешен</option>
                                    </select>
                                </label>-->
            </div>
            <div class="col-12">
                <div class="btn_wrapper">
                    <ConfirmBtn :text="confirm"
                                @confirmEvent=""></ConfirmBtn>
                    <CancelBtn></CancelBtn>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import ConfirmBtn from "../buttons/ConfirmBtn";
import CancelBtn from "../buttons/CancelBtn";
import Message from "../message/Message";

export default {
    name: "UserAccess",
    components: {
        ConfirmBtn, CancelBtn, Message
    },
    data() {
        return {
            confirm: 'Подтвердить',
            settings: [
                {
                    id: 1,
                    title: 'Диск',
                    status: 0
                },
                {
                    id: 2,
                    title: 'Почта',
                    status: 0
                },
                {
                    id: 3,
                    title: 'Календарь',
                    status: 0
                },
                {
                    id: 4,
                    title: 'Фотографии',
                    status: 0
                },
                {
                    id: 5,
                    title: 'Контакты',
                    status: 0
                },
            ],
        }
    },
}
</script>

<style lang="scss">
.user_access {
    max-width: 450px;
    margin: 0 auto;
    padding-top: 24px;

    .edit_form__label {
        margin-bottom: 12px;
        max-width: 377px;
        margin-left: auto;
        margin-right: auto;

        &:last-child {
            margin-bottom: 0;
        }
    }

    .input_title {
        margin-bottom: 20px;
    }

    .confirm_btn, .cancel_btn {
        width: 213px;
    }

}

</style>
