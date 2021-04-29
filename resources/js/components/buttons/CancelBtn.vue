<template>
    <button class="settings__btn cancel_btn" @click="cancel">Отмена</button>
</template>

<script>

export default {
    name: "CancelBtn",
    methods:{
        cancel(){
            this.$emit('cancelEvent')
        }
    }
}
</script>

<style lang="scss">
@import "../../../sass/variables";
.cancel_btn {
    color: #B2B2B2;
    border: 2px solid #F5F5F5;
    background: #FFFFFF;
    //box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);
}
</style>
