<template>
    <div class="users_management__settings users_management__confirm"
         v-if="UM_SETTINGS_STATUS.confirmStatus"
         :class="UM_SETTINGS_STATUS.confirmStatus ? 'settings_show' : ''"
         @click="closeConfirm($event)">
        <div class="wrapper">
            <div class="title_row">
                <div class="title">Подтверждение удаления</div>
                <div class="description" v-if="counter === 1">Вы уверены, что хотите удалить данную запись?</div>
                <div class="description" v-if="counter > 1">Вы уверены, что хотите удалить данные записи?</div>
            </div>
            <div class="btn_wrapper confirm__btn_wrapper">
                <confirm-btn
                    :text="removeBtnText"
                    @confirmEvent="remove">
                </confirm-btn>
                <cancel-btn @cancelEvent="changeConfirm"></cancel-btn>
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
    props: ['userDataLength'],
    components: {
        'cancel-btn': CancelBtn,
        'confirm-btn': ConfirmBtn
    },
    data() {
        return {
            removeBtnText: 'Удалить',
            counter: 0
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
        remove() {
            this.$emit('deleteEvent')
            // this.changeUMConfirmStatus()
        },
        setCounter() {
            this.counter = this.userDataLength
            console.log('this.counter',this.counter)
        }
    },
    computed: {
        ...mapGetters([
            'UM_SETTINGS_STATUS'
        ]),
    },
    created() {
        this.setCounter()

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
