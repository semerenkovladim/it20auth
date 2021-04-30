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
                <li class="row option"
                    v-for="option in settings" :key="option.id">
                    <div class="col-8 option__col col_name">{{ option.name }}</div>
                    <div class="col-4 option__col option_checkbox ">
                        <label><input type="checkbox" class="input_checkbox" v-model="option.status"></label>
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
    components: {
        'cancel-btn': CancelBtn,
        'confirm-btn': ConfirmBtn
    },
    data() {
        return {
            settings: [
                {
                    id: 1,
                    name: 'Фамилия',
                    status: false
                },
                {
                    id: 2,
                    name: 'Имя',
                    status: false
                },
                {
                    id: 3,
                    name: 'Отчество',
                    status: false
                },
                {
                    id: 4,
                    name: 'E-mail',
                    status: false
                },
                {
                    id: 5,
                    name: 'Должность',
                    status: false
                },
                {
                    id: 6,
                    name: 'Отдел',
                    status: false
                },
                {
                    id: 7,
                    name: 'Дата рождения',
                    status: false
                },
                {
                    id: 8,
                    name: 'Доступные модули',
                    status: false
                },
                {
                    id: 9,
                    name: 'Роль в системе',
                    status: false
                },
            ],
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
            this.changeUMSettingStatus()
        },
        cancel() {
            this.changeUMSettingStatus()
        }
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
