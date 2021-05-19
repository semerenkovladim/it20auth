<template>
    <div class="user_edit_form user_access col-12">
        <MessagePopup :popup-show="popup.show"
                      :popup-message="popup.message"
                      @closePopup="popup.show = false">
        </MessagePopup>
        <form action="#" method="post" class="row user_edit_form__form">
            <div class="col-12">
                <label class="edit_form__label">
                    <span class="input_title">Диск:</span>
                    <select name="position"
                            class="styled"
                            v-model="access.disk">
                        <option value="0">Запрещен</option>
                        <option value="1">Разрешен</option>
                    </select>
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Почта:</span>
                    <select name="position"
                            class="styled"
                            v-model="access.mail">
                        <option value="0">Запрещен</option>
                        <option value="1">Разрешен</option>
                    </select>
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Календарь:</span>
                    <select name="position"
                            class="styled"
                            v-model="access.calendar">
                        <option value="0">Запрещен</option>
                        <option value="1">Разрешен</option>
                    </select>
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Фотографии:</span>
                    <select name="position"
                            class="styled"
                            v-model="access.photo">
                        <option value="0">Запрещен</option>
                        <option value="1">Разрешен</option>
                    </select>
                </label>
                <label class="edit_form__label">
                    <span class="input_title">Контакты:</span>
                    <select name="position"
                            class="styled"
                            v-model="access.contacts">
                        <option value="0">Запрещен</option>
                        <option value="1">Разрешен</option>
                    </select>
                </label>
            </div>
            <div class="col-12">
                <div class="btn_wrapper">
                    <ConfirmBtn :text="confirm"
                                @confirmEvent="updateAccess"></ConfirmBtn>
                    <CancelBtn @cancelEvent="$router.push('/users-management')"> </CancelBtn>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import ConfirmBtn from "../buttons/ConfirmBtn";
import CancelBtn from "../buttons/CancelBtn";
import MessagePopup from "../message-popup/MessagePopup";

export default {
    name: "UserAccess",
    props: ['data'],
    components: {
        ConfirmBtn, CancelBtn, MessagePopup
    },
    data() {
        return {
            confirm: 'Подтвердить',
            settings: [
                'Диск',
                'Почта',
                'Календарь',
                'Фотографии',
                'Контакты',
            ],
            userId: 0,
            access: {
                disk: 0,
                mail: 0,
                calendar: 0,
                photo: 0,
                contacts: 0
            },
            popup: {
                message: '',
                show: false
            }
        }
    },
    methods: {
        getUserAccess(id) {
            console.log('getUserAccess', id)
            return axios.get('/api/user-permission/' + id)
                .then(value => {
                    if (value.data.status) {
                        this.access = value.data.data
                    }
                    console.log('this.access', this.access)
                })
        },
        setData() {
            this.userId = this.data.id
        },
        updateAccess() {
            this.$emit('accessUpdate',this.access)
        },
        setAccess(){
            this.access = {}
            if (this.data.access_level) {
                this.access = this.data.access_level
                console.log('this.access = this.data.access_level')
            } else {
                console.log('this.getUserAccess(this.userId)')
                this.getUserAccess(this.userId)
            }
        }
    },
    computed: {
        setUserData() {
            return this.data.id
        },
        changeUserId() {
            return this.userId
        }
    },
    watch: {
        setUserData() {
            this.setData()

        },
        changeUserId() {
            this.setAccess()
        }
    },
    created(){
        this.setAccess()
    }
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
