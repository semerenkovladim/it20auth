<template>
    <div class="message-component"
         v-if="UM_MESSAGE.show"
         @click="hide($event)">
        <div class="message-component__wrapper">
            <div class="title">
                <div v-if="UM_MESSAGE.status">Успешно!</div>
                <div v-else>Ошибка!</div>
            </div>
            <div class="message-component__message">
                <ul>
                    <li class="message_string"
                        v-for="err in UM_MESSAGE.data">
                        {{ err[0] }}
                    </li>
                </ul>
            </div>
            <ConfirmBtn :text="text2"
                        v-if="!UM_MESSAGE.status"
                        @confirmEvent="hideUMMessage">
            </ConfirmBtn>
            <ConfirmBtn :text="text"
                        v-if="UM_MESSAGE.status"
                        @confirmEvent="hideUMMessage">
            </ConfirmBtn>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import ConfirmBtn from "../buttons/ConfirmBtn";

export default {
    name: "Message",
    components: {
        ConfirmBtn
    },
    data() {
        return {
            text: 'Ок',
            text2: 'cancel'
        }
    },
    methods: {
        ...mapActions([
            'getUMMessage',
            'hideUMMessage'
        ]),
        hide(event) {
            if (event.target.classList.contains('message-component')) this.hideUMMessage()
        },
        complete() {
            this.$emit('confirmEvent')
            this.hideUMMessage()
        }
    },
    computed: {
        ...mapGetters([
            'UM_MESSAGE'
        ])
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.message-component {
    position: fixed;
    z-index: 99999;
    height: 100vh;
    width: 100vw;
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-left: 15px;
    padding-right: 15px;
    background: rgba(196, 196, 196, 0.8);

    .title {
        padding-top: 10px;
        padding-bottom: 15px;
    }

    .confirm_btn {
        margin: auto;
    }
}

.message-component__wrapper {
    background: #FFFFFF;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);
    border-radius: 6px;
    padding: 40px;
}

.message-component__message {
    margin-bottom: 15px;
}

.message_string {
    padding-top: 5px;
    padding-bottom: 5px;
    font-weight: 500;
    font-size: 14px;
    color: $lightColor;
}
</style>
