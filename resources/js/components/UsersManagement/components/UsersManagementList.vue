<template>
    <div class="wrapper">
        <div class="users_management__sort">
            <ul class="row users_management__sort_list flex-nowrap">
                <li class="col-1 sort_item"></li>
                <li class="col-2 sort_item"
                    v-if="settings.surname"
                    @click="setOrder('surname')">
                    <span :class="order ==='surname' && desc ? 'ordered':''">Фамилия</span>
                </li>
                <li class="col-2 sort_item"
                    v-if="settings.name"
                    @click="setOrder('name')">
                    <span :class="order ==='name' && desc ? 'ordered':''">Имя</span>
                </li>
                <li class="col-2 sort_item"
                    v-if="settings.patronymic"
                    @click="setOrder('middle_name')">
                    <span :class="order ==='middle_name' && desc ? 'ordered':''">Отчество</span>
                </li>
                <li class="col-3 sort_item"
                    v-if="settings.email"
                    @click="setOrder('email')">
                    <span :class="order ==='email' && desc ? 'ordered':''">E-mail</span>
                </li>
                <li class="col-2 sort_item"
                    v-if="settings.position"
                    @click="setOrder('position')">
                    <span :class="order ==='position' && desc ? 'ordered':''">Должность</span>
                </li>
                <li class="col-2 sort_item"
                    v-if="settings.department"
                    @click="setOrder('department_id')">
                    <span :class="order ==='department_id' && desc ? 'ordered':''">Отдел</span>
                </li>
                <li class="col-2 sort_item"
                    v-if="settings.date_of_birth"
                    @click="setOrder('birth')">
                    <span :class="order ==='birth' && desc ? 'ordered':''">Дата рождения</span>
                </li>
                <li class="col-3 sort_item non_sorted"
                    v-if="settings.modules">
                    <span>Модули</span>
                </li>
                <li class="col-2 sort_item"
                    v-if="settings.role"
                    @click="setOrder('is_admin')">
                    <span :class="order ==='id_admin' ? 'ordered':''">Роль</span>
                </li>
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
                            <input type="checkbox"
                                   :id="'user_'+ user.id"
                                   class="user_check input_checkbox"
                                   v-model="user.checked"
                                   @change="changeCheck"
                            >
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
                        <li class="user_info__item col-3" v-if="settings.modules">
                            <span v-if="user.access_level">
                                {{ setModules(user.access_level) }}
                            </span>
                            <span v-else>-</span>
                        </li>
                        <li class="user_info__item col-2" v-if="settings.role">
                            {{ user.is_admin ? 'Админ' : 'Пользователь' }}
                        </li>
                    </ul>
                </label>
            </li>
        </ul>

        <div class="not_found" v-else>{{notFoundMessage}}</div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "UsersManagementList",
    props: ['data', 'checkStatus', 'settings','notFoundMessage'],
    data() {
        return {
            selectUsers: [],
            order: '',
            desc: false
        }
    },
    methods: {
        setOrder(order) {
            if (this.order === order) {
                this.desc = !this.desc
            } else {
                this.desc = false
            }
            this.order = order
            this.$emit('orderEvent', {order: order, desc: this.desc})
        },
        setModules(data) {
            let arr = []
            if (data.disk) arr.push('Диск')
            if (data.mail) arr.push('Почта')
            if (data.calendar) arr.push('Календарь')
            if (data.photo) arr.push('Фото')
            if (data.contacts) arr.push('Контакты')
            return arr.length > 0 ? arr.join(', ') : '-'
        },
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

        &::-webkit-scrollbar {
            height: 6px;
            cursor: pointer;
            background-color: lighten($designColorOne, 42%);
        }

        &::-webkit-scrollbar-button {
            display: none;
            width: 0;
            height: 0;
        }

        &::-webkit-scrollbar-track {
            background-color: transparent;
        }

        &::-webkit-scrollbar-track-piece {
            background-color: transparent;
        }

        &::-webkit-scrollbar-thumb {
            border-radius: 15px;
            background-color: lighten($designColorOne, 20%);
            cursor: pointer;

            &:hover {
                cursor: pointer;
                background-color: lighten($designColorOne, 10%);
            }
        }

        &::-webkit-scrollbar-corner {
            background-color: transparent;
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
        min-height: 55px;
    }

    .sort_item {
        font-size: 13px;
        color: $darkColor;
        font-weight: 600;
        display: flex;
        align-items: center;
        cursor: pointer;

        span {
            min-height: 26px;
            align-items: center;
            display: flex;
            padding-right: 33px;
            position: relative;

            &:after {
                transition: 0.3s ease;
                content: '';
                display: block;
                position: absolute;
                height: 26px;
                width: 29px;
                right: 0;
                top: 0;
                background: url("../../../../images/icons/arrow_down.svg") no-repeat center / 100%;
            }

        }

        .ordered {
            &:after {
                transform: rotateX(180deg);
            }
        }

        &:first-child {
            span {
                background: none;
            }
        }
    }

    .non_sorted {
        cursor: default;
        span {
            &:after {
                background: none;
            }
        }
    }
}
</style>
