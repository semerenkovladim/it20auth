<template>
    <div class="users_management__settings users_management__confirm">
        <div class="wrapper">
            <div class="col">
                <div class="row title_row">
                    <div class="col title">Подтверждение удаления</div>
                    <div class="col description">Вы уверены, что хотите удалить данную запись?</div>
                </div>
                <div class="btn_wrapper">
                    <confirm-btn :text="confirmBtnText"></confirm-btn>
                    <cancel-btn></cancel-btn>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CancelBtn from "../buttons/CancelBtn";
import ConfirmBtn from "../buttons/ConfirmBtn";

export default {
    name: "UserManagementConfirm",
    components: {
        'cancel-btn': CancelBtn,
        'confirm-btn': ConfirmBtn
    },
    data() {
        return {
            confirmBtnText: 'Удалить'
        }
    }
}
</script>

<style scoped>

</style>
