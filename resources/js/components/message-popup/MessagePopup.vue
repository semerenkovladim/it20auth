<template>
    <div class="popup_message" v-if="popupShow" @click="checkTarget($event)">
        <div class="popup_message__wrapper">
            <div class="popup_message__message">{{ popupMessage }}</div>
            <div class="popup_message__btn_wrapper">
                <ConfirmBtn :text="btnText" @confirmEvent="closePopup"></ConfirmBtn>
            </div>
            <div class="cancel_element" @click="closePopup">
                <div class="cancel_wrapper"></div>
            </div>
        </div>
    </div>
</template>

<script>

import ConfirmBtn from "../buttons/ConfirmBtn";

export default {
    name: "MessagePopup",
    props: ['popupShow', 'popupMessage'],
    components: {
        ConfirmBtn
    },
    data() {
        return {
            btnText: 'ОК',
        }
    },
    methods: {
        closePopup() {
            this.$emit('closePopup')
        },
        checkTarget(event) {
            if (event.target.classList.contains('popup_message')) this.closePopup()
        }
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.popup_message {
    top: 0;
    left: 0;
    position: fixed;
    z-index: 9999999;
    height: 100vh;
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(196, 196, 196, 0.8);

    .popup_message__btn_wrapper {
        display: flex;
        justify-content: flex-end;
    }

    .popup_message__message {
        font-weight: 500;
        font-size: 18px;
        color: #666666;
        margin-bottom: 35px;
    }

    .popup_message__wrapper {
        position: relative;
        background: #FFFFFF;
        border-radius: $borderRad;
        box-shadow: $userManagementRowBoxShadow;
        width: 100%;
        max-width: 500px;
        padding: 30px;
    }

    .cancel_element {
        top: 10px;
        right: 10px;
        position: absolute;
        width: 20px;
        height: 20px;
        display: flex;
        cursor: pointer;
    }

    .cancel_wrapper {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;


        &:before, &:after {
            position: absolute;
            content: '';
            display: block;
            background: rgb(226, 226, 226);
            width: 100%;
            height: 2px;
            border-radius: 5px;
        }

        &:before {
            transform: rotate(-45deg);
        }

        &:after {
            transform: rotate(45deg);
        }

        &:hover {
            &:before, &:after {
                background: darken(rgb(226, 226, 226), 5%);
            }
        }
    }
}

</style>
