<template>
    <button class="settings__btn confirm_btn"
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
}

</style>
