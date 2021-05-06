<template>
    <button class="settings__btn confirm_btn"
            type="button"
            @click="confirm">
        {{ text }}
    </button>
</template>

<script>

export default {
    name: "ConfirmBtn",
    props: ['text'],
    methods: {
        changeSettings() {
            this.changeUMSettingStatus()
        },
        confirm() {
            this.$emit('confirmEvent')
        }
    }
}
</script>

<style lang="scss">
@import "../../../sass/variables";

.confirm_btn {
    background: $designColorOne;
    color: #FFFFFF;
    margin-right: 10px;
    &:hover {
        background: darken($designColorOne, 5%);
    }
}
.btn_wrapper {
    display: flex;
    align-items: center;
    justify-content: center;

}

.settings__btn {
    font-style: normal;
    //width: 100%;
    width: 120px;
    min-height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    font-size: 12px;
    text-align: center;
    text-transform: uppercase;
    border-radius: 4px;
}

</style>
