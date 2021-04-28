<template>
    <button class="settings__btn cancel_btn"
            @click="cancel">Отмена
    </button>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "CancelBtn",
    methods: {
        ...mapActions([
            'changeUMSettingStatus'
        ]),
        cancel() {
            this.changeUMSettingStatus()
        }
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";
.cancel_btn {
    color: #B2B2B2;
    border: 2px solid #F5F5F5;
    background: #FFFFFF;
    //box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);
}
</style>
