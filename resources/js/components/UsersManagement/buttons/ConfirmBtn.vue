<template>
    <button class="settings__btn confirm_btn"
            @click="changeSettings">{{text}}
    </button>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "ConfirmBtn",
    props:['text'],
    methods: {
        ...mapActions([
            'changeUMSettingStatus'
        ]),
        changeSettings() {
            this.changeUMSettingStatus()
        },
    },
    computed: {
        ...mapGetters([
            'UM_SETTINGS_STATUS'
        ])

    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";
.confirm_btn {
    background: $designColorOne;
    color: #FFFFFF;
    margin-right: 10px;
}

</style>
