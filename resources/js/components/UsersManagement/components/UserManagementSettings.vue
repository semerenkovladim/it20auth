<template>
    <div class="users_management__settings"
         @click="closeSettings($event)"
         :class="UM_SETTINGS_STATUS.settingStatus ? 'settings_show' : ''"
         v-if="UM_SETTINGS_STATUS.settingStatus">
        <div class="wrapper">
            <div class="row title_row">
                <div class="col title">Управление столбцами таблицы</div>
            </div>
            <ul class="settings">
                <li class="row option col_desc">
                    <div class="col-8 option__col col_name">Столбец:</div>
                    <div class="col-4 option__col col_name">Отображать:</div>
                </li>
                <li class="row option">
                    <div class="col-8 option__col col_name">Фамилия</div>
                    <div class="col-4 option__col option_checkbox ">
                        <label><input type="checkbox" class="input_checkbox" v-model="settings.surname"></label>
                    </div>
                </li>
                <li class="row option">
                    <div class="col-8 option__col col_name">Имя</div>
                    <div class="col-4 option__col option_checkbox ">
                        <label><input type="checkbox" class="input_checkbox" v-model="settings.name"></label>
                    </div>
                </li>
                <li class="row option">
                    <div class="col-8 option__col col_name">Отчество</div>
                    <div class="col-4 option__col option_checkbox ">
                        <label><input type="checkbox" class="input_checkbox" v-model="settings.patronymic"></label>
                    </div>
                </li>
                <li class="row option">
                    <div class="col-8 option__col col_name">E-mail</div>
                    <div class="col-4 option__col option_checkbox ">
                        <label><input type="checkbox" class="input_checkbox" v-model="settings.email"></label>
                    </div>
                </li>
                <li class="row option">
                    <div class="col-8 option__col col_name">Должность</div>
                    <div class="col-4 option__col option_checkbox ">
                        <label><input type="checkbox" class="input_checkbox" v-model="settings.position"></label>
                    </div>
                </li>
                <li class="row option">
                    <div class="col-8 option__col col_name">Отдел</div>
                    <div class="col-4 option__col option_checkbox ">
                        <label><input type="checkbox" class="input_checkbox" v-model="settings.department"></label>
                    </div>
                </li>
                <li class="row option">
                    <div class="col-8 option__col col_name">Дата рождения</div>
                    <div class="col-4 option__col option_checkbox ">
                        <label><input type="checkbox" class="input_checkbox" v-model="settings.date_of_birth"></label>
                    </div>
                </li>
                <li class="row option">
                    <div class="col-8 option__col col_name">Доступные модули</div>
                    <div class="col-4 option__col option_checkbox ">
                        <label><input type="checkbox" class="input_checkbox" v-model="settings.modules"></label>
                    </div>
                </li>
                <li class="row option">
                    <div class="col-8 option__col col_name">Роль в системе</div>
                    <div class="col-4 option__col option_checkbox ">
                        <label><input type="checkbox" class="input_checkbox" v-model="settings.role"></label>
                    </div>
                </li>
            </ul>
            <div class="btn_wrapper">
                <confirm-btn
                    :text="confirmBtnText"
                    v-on:confirmEvent="confirm"></confirm-btn>
                <cancel-btn v-on:cancelEvent="cancel"></cancel-btn>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import CancelBtn from "../../buttons/CancelBtn";
import ConfirmBtn from "../../buttons/ConfirmBtn";

export default {
    name: "UserManagementSettings",
    props: ['data'],
    components: {
        'cancel-btn': CancelBtn,
        'confirm-btn': ConfirmBtn
    },
    data() {
        return {
            settings: {},
            confirmBtnText: 'Подтвердить'
        }
    },
    methods: {
        ...mapActions([
            'changeUMSettingStatus'
        ]),
        closeSettings(event) {
            if (event.target.classList.contains('users_management__settings')) this.changeUMSettingStatus()
        },
        confirm() {
            axios.put('/api/admin-settings/update', this.settings).then(value => {
                this.changeUMSettingStatus()
            })
        },
        cancel() {
            this.changeUMSettingStatus()
        }
    },
    computed: {
        ...mapGetters([
            'UM_SETTINGS_STATUS'
        ]),
        changeSettings() {
            return this.data
        },
        changeSettings2() {
            return Object.values(this.settings)
        }

    },
    watch: {
        changeSettings() {
            this.settings = this.data
        }
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.users_management__settings {
    position: fixed;
    z-index: 99999;
    align-items: center;
    justify-content: center;
    height: 100vh;
    width: 100vw;
    top: 0;
    left: 0;
    background: rgba(196, 196, 196, 0.8);
    opacity: 0;
    visibility: hidden;
    display: none;

    .settings {
        margin-bottom: 20px;
    }

    .settings, .btn_wrapper {
        padding-left: 12px;
        padding-right: 12px;
    }

    .wrapper {
        width: 100%;
        max-width: 444px;
        background: #FFFFFF;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);
        border-radius: 6px;
        padding: 40px;
    }

    .title_row {
        margin-bottom: 25px;
    }

    .title {
        font-size: 18px;
        color: $darkColor;
        font-weight: 600;
        text-align: left;
    }

    .option {
        margin-bottom: 13px;

        &:last-child {
            margin-bottom: 0;
        }
    }

    .option__col {
        height: 30px;
        align-items: center;
        display: flex;
        font-size: 14px;
        color: $darkColor;
        font-weight: 600;
    }

    .input_checkbox {
        margin-left: 0;
    }

    .btn_wrapper {
        justify-content: flex-start;
    }
}

.settings_show {
    display: flex;
    opacity: 1;
    visibility: visible;
    animation: showEl ease 0.2s;
}

@keyframes showEl {
    0% {
        opacity: 0;
        visibility: hidden;
    }
    100% {
        opacity: 1;
        visibility: visible;
    }
}
</style>
