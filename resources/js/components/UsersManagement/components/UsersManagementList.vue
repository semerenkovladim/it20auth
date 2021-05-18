<template>
    <div class="wrapper">
        <div class="users_management__sort">
            <ul class="row users_management__sort_list flex-nowrap">
                <li class="col-1 sort_item"></li>
                <li class="col-2 sort_item" v-if="settings.surname"><span>Фамилия</span></li>
                <li class="col-2 sort_item" v-if="settings.name"><span>Имя</span></li>
                <li class="col-2 sort_item" v-if="settings.patronymic"><span>Отчество</span></li>
                <li class="col-3 sort_item" v-if="settings.email"><span>E-mail</span></li>
                <li class="col-2 sort_item" v-if="settings.position"><span>Должность</span></li>
                <li class="col-2 sort_item" v-if="settings.department"><span>Отдел</span></li>
                <li class="col-2 sort_item" v-if="settings.date_of_birth"><span>Дата рождения</span></li>
                <li class="col-2 sort_item" v-if="settings.modules"><span>Модули</span></li>
                <li class="col-2 sort_item" v-if="settings.role"><span>Роль</span></li>
            </ul>
        </div>
        <ul class="users_management__user_list"
            v-if="data.length"
            :key="checkStatus">
            <li class="user"
                v-for="user in data"
                :key="user.id">
                <label :for="'user_'+ user.id" class="w-100 d-block">
                <ul class="row user__info flex-nowrap">
                    <li class="user_info__item col-1 user_checkbox">
                        <!--                        <label>-->
                        <input type="checkbox"
                               :id="'user_'+ user.id"
                               class="user_check input_checkbox"
                               v-model="user.checked"
                               @change="changeCheck"
                        >
                        <!--                        </label>-->
                    </li>
                    <li class="user_info__item col-2" v-if="settings.surname">{{ user.surname }}</li>
                    <li class="user_info__item col-2" v-if="settings.name">{{ user.name }}</li>
                    <li class="user_info__item col-2" v-if="settings.patronymic">
                        {{ user.middle_name ? user.middle_name : '-' }}
                    </li>
                    <li class="user_info__item col-3" v-if="settings.email">
                        <a :href="'mailto:' + user.email">{{ user.email }}</a>
                    </li>
                    <li class="user_info__item col-2" v-if="settings.position">{{
                            user.position ? user.position : '-'
                        }}
                    </li>
                    <li class="user_info__item col-2" v-if="settings.department">
                        {{ user.department ? user.department.title : '-' }}
                    </li>
                    <li class="user_info__item col-2" v-if="settings.date_of_birth">{{ user.birth }}</li>
                    <li class="user_info__item col-2" v-if="settings.modules">{{ user.modules ? user.modules : '-' }}
                    </li>
                    <li class="user_info__item col-2" v-if="settings.role">
                        {{ user.is_admin ? 'Админ' : 'Пользователь' }}
                    </li>
                </ul>
                </label>
            </li>
        </ul>

        <div class="not_found" v-else>Пользователи не найдены</div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "UsersManagementList",
    props: ['data', 'checkStatus', 'settings'],
    data() {
        return {
            selectUsers: []
        }
    },
    methods: {
        changeCheck() {
            let status = true
            for (let item of this.data) {
                if (item.checked === undefined || !item.checked) {
                    item.checked = false
                }
                let index = this.selectUsers.findIndex(x => x.id === item.id)

                if (item.checked) {
                    if (index === -1) {
                        this.selectUsers.push(item)
                    }
                } else {
                    this.$emit('allChecked', {status: false})
                    status = false

                    if (index > -1) {
                        this.selectUsers.splice(index, 1)
                    }
                }
            }

            if (status) {
                this.$emit('allChecked', {status: true})
            }
        },

    },
    computed: {
        ...mapGetters([
            'ALL_DEPARTMENTS'
        ]),
        selectUsersLength() {
            return this.selectUsers.length
        }
    },
    watch: {
        selectUsersLength() {
            this.$emit('changeUsersLength', {
                length: this.selectUsers.length,
                data: this.selectUsers
            })
        },
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.users_management__user_list {
    min-height: 55px;

    .user {
        &:last-child {
            .user_info__item {
                border-bottom: none;
            }

            .user__info {
                border-bottom: none;
            }
        }
    }

    .user__info {
        font-size: $userManagementUserFz;
        min-height: 55px;

    }

    .user_info__item {
        display: flex;
        align-items: center;
        font-weight: 600;
        word-break: break-all;
        border-bottom: 2px solid #F5F5F5;

        a {
            color: $lightColor;
        }
    }

    .user_checkbox {
        justify-content: flex-start;
        padding-left: 30px;

        label {
            justify-content: flex-start;
            padding-left: 15px;
        }

        input {
            margin: 0;
        }
    }
}

.users_management__sort .sort_item, .users_management__user_list .user__info {
    color: $userManagementUserColor;
    //border-bottom: 2px solid #F5F5F5;
    font-style: normal;
    font-weight: 500;

}

.users_management__list {
    display: flex;
    flex-direction: column;

    .sort_item {
        border-bottom: 2px solid #F5F5F5
    }

    .wrapper {
        padding: 0 15px;
        margin-right: -15px;
        margin-left: -15px;
        overflow-x: auto;
        margin-bottom: 4px;
        height: 100%;
        display: flex;
        flex-direction: column;

        > * {
            min-width: 800px;
        }
    }

    .not_found {
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        width: 100%;
        font-weight: 600;
        font-size: 18px;
        color: $lightColor;
    }

    .search_user {
        padding: 0 15px;
        flex: 1 1 66%;

    }

    .edit__actions_list {
        justify-content: space-between;
        padding: 0 15px;
        flex: 1 1 10%;

        .row {
            justify-content: space-evenly;
            padding: 0 15px;

        }
    }
}

.users_management__sort {
    .users_management__sort_list {
        border-top: 2px solid #F5F5F5;
        min-height: 55px;
    }

    .sort_item {
        font-size: 13px;
        color: $darkColor;
        font-weight: 600;
        display: flex;
        align-items: center;

        span {
            min-height: 26px;
            align-items: center;
            display: flex;
            padding-right: 33px;
            background: url("../../../../images/icons/arrow_down.svg") no-repeat top right / contain;

        }

        &:first-child {
            span {
                background: none;
            }
        }
    }

}
</style>
