<template>
    <div class="users_management__settings users_management__confirm"
         v-if="UM_SETTINGS_STATUS.confirmStatus"
         :class="UM_SETTINGS_STATUS.confirmStatus ? 'settings_show' : ''"
         @click="closeConfirm($event)">
        <div class="wrapper">
            <div class="title_row">
                <div class="title">Подтверждение удаления</div>
                <div class="description">Вы уверены, что хотите удалить данную запись?</div>
            </div>
            <div class="btn_wrapper confirm__btn_wrapper">
                <confirm-btn
                    :text="removeBtnText"
                    v-on:confirmEvent="removeItem">
                </confirm-btn>
                <cancel-btn v-on:cancelEvent="changeConfirm"></cancel-btn>
            </div>
        </div>
    </div>
</template>

<script>
import CancelBtn from "../../buttons/CancelBtn";
import ConfirmBtn from "../../buttons/ConfirmBtn";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "UserManagementConfirm",
    components: {
        'cancel-btn': CancelBtn,
        'confirm-btn': ConfirmBtn
    },
    data() {
        return {
            removeBtnText: 'Удалить'
        }
    },
    methods: {
        ...mapActions([
            'changeUMConfirmStatus'
        ]),
        closeConfirm(event) {
            if (event.target.classList.contains('users_management__confirm')) this.changeUMConfirmStatus()
        },
        changeConfirm() {
            this.changeUMConfirmStatus()
        },
        removeItem() {
            this.changeUMConfirmStatus()
        }
    },
    computed: {
        ...mapGetters([
            'UM_SETTINGS_STATUS'
        ])
    }
}
</script>

<style scoped lang="scss">
.users_management__confirm {
    .title {
        min-height: 30px;
        display: flex;
        align-items: center;
        margin-bottom: 34px;
    }

    .description {
        min-height: 20px;
        display: flex;
        align-items: center;
        margin-bottom: 55px;
    }

    .confirm__btn_wrapper {
        padding-left: 0;
        padding-right: 0;
    }
}

</style>
