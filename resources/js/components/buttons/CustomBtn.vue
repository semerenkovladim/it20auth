<template>
    <button class="settings__btn custom_btn">{{ text }}
    </button>
</template>

<script>
export default {
    props: ['text'],
    name: "CustomBtn"
}
</script>

<style lang="scss">
@import "../../../sass/variables";

.custom_btn {
    background: $designColorOne;
    color: #FFFFFF;
    margin-right: 10px;
}
</style>
