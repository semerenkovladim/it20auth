<template>
    <main class="row users_management">
        <user-management-settings></user-management-settings>
        <user-management-confirm></user-management-confirm>
        <div class="container-fluid users_management__container">
            <div class="wrapper col">
                <placeholder :text="placeholderText"
                             :links="links">
                </placeholder>
                <div class="row users_management__row users_management__wrapper">
                    <div class="col-md-3 users_management__col">
                        <div class="users_management__add_user">
                            <button class="add_user__btn" type="button"
                                    @click="$router.push('/users-management/new-user')">Добавить пользователя
                            </button>
                        </div>
                        <div class="users_management__users_filter">
                            <department-list :data="departments"
                                             @sendDepartmentId="setDepartmentId">
                            </department-list>
                        </div>
                    </div>
                    <div class="col-md-9 users_management__col users_management__list">
                        <div class="users_management__edit">
                            <div class="row">
                                <div class="col-1 edit__action edit__action_checkbox">
                                    <label>
                                        <input type="checkbox"
                                               class="select_all input_checkbox"
                                               @change="checkStatus = !checkStatus"
                                               v-model="checkAll">
                                    </label>
                                </div>
                                <div class="edit__actions_list">
                                    <ul class="row">
                                        <li class="edit__action">
                                            <button class="edit_btn"
                                                    type="button"
                                                    @click="$router.push({
                                                        path:'/users-management/user-edit',
                                                        query:{id:selectUsers[0].id}
                                                    })"
                                                    :disabled="usersCount !==1">
                                            </button>
                                        </li>
                                        <li class="edit__action">
                                            <button class="remove_btn"
                                                    type="button"
                                                    @click="removeUser">
                                            </button>
                                        </li>
                                        <li class="edit__action">
                                            <button class="setting_btn"
                                                    type="button"
                                                    @click="toggleSettings">
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <form action="#" method="get" class="search_user">
                                    <div class="row search__row flex-nowrap">
                                        <label class="col-10">
                                            <input type="search"
                                                   name="search"
                                                   placeholder="Поиск">
                                        </label>
                                        <button class="col-2 search_btn" type="button"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <users-management-list
                            v-if="UM_USERS.data.length"
                            :data="UM_USERS.data"
                            :checkStatus="checkStatus"
                            @allChecked="setAllCheck"
                            @changeUsersLength="userCount">
                        </users-management-list>
                        <div class="not_found" v-else>Пользователи не найдены</div>
                    </div>
                </div>
                <div class="row users_management__paginator_row"
                     v-if="UM_USERS.data.length">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <div class="row paginator_row">
                            <paginator :data="UM_USERS"
                                       @toPage="setCurrentPage">

                            </paginator>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import Placeholder from "../../placeholder/Placeholder";
import UserManagementConfirm from "./UserManagementConfirm";
import UserManagementSettings from "./UserManagementSettings";
import UsersManagementList from "./UsersManagementList";
import DepartmentList from "./DepartmentList";
import Paginator from "../../paginator/Paginator";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "UsersManagement",
    components: {
        'placeholder': Placeholder,
        'paginator': Paginator,
        'user-management-settings': UserManagementSettings,
        'user-management-confirm': UserManagementConfirm,
        'users-management-list': UsersManagementList,
        'department-list': DepartmentList
    },
    data() {
        return {
            settingsStatus: false,
            placeholderText: 'Управление пользователями',
            links: [
                {
                    id: 1,
                    name: 'Управление',
                    href: '#'
                },
                {
                    id: 2,
                    name: 'Пользователи',
                    href: '/users-management'
                },
            ],
            departments: [
                {
                    id: 1,
                    name: 'Все пользователи',
                    status: true
                },
                {
                    id: 2,
                    name: 'Отдел сайтов',
                    status: false
                },
                {
                    id: 3,
                    name: 'Отдел разработки проектов',
                    status: false
                },
                {
                    id: 4,
                    name: 'Отдел дизайна',
                    status: false
                },
            ],
            checkAll: false,
            checkStatus: false,
            usersCount: '',
            selectUsers: [],
            currentDepartment: 0,
            currentPage: 1
        }
    },
    methods: {
        ...mapActions([
            'changeUMSettingStatus',
            'changeUMConfirmStatus',
            'getUMAllUsers',
            'getUsersInDepartment'

        ]),
        setDepartmentId(data) {
            this.currentDepartment = data.id
            this.currentPage = 1
            this.getUsers(this.currentPage)
        },
        userCount(data) {
            this.usersCount = data.length
            this.selectUsers = data.data
        },
        setAllCheck(data) {
            this.checkAll = data.status
        },
        toggleSettings() {
            this.changeUMSettingStatus()
        },
        removeUser() {
            this.changeUMConfirmStatus()
        },
        setCurrentPage(data) {
            if (this.UM_USERS.last_page >= data.page >= 1) {
                this.currentPage = data.page
                this.getUsers()
            }
        },
        getUsers() {
            if (this.currentDepartment > 1) {
                this.getUsersInDepartment({id: this.currentDepartment - 1, page: this.currentPage})
            } else {
                this.getUMAllUsers(this.currentPage)
            }
        },

    },
    computed: {
        ...mapGetters([
            'UM_USERS'
        ]),
        checkSelectAll() {
            return this.checkAll
        },
        setStatus() {
            return this.setStatus
        }
    },
    watch: {
        checkSelectAll() {
            if (this.checkAll) this.checkStatus = this.checkAll
        }
    },
    created() {
        this.getUMAllUsers()
    }
}
</script>

<style lang="scss" scoped>
@import "../../../../sass/variables";

* {
    font-family: $userManagementFF;
    transition: 0.2s ease;
    font-style: normal;
}


.search__row {
    align-items: center;
    background: transparent;

    input {
        background: transparent;
        padding: 5px 15px;
        border-radius: 6px;
        font-style: normal;
        color: $lightColor;
        font-size: 14px;

        &::placeholder {
            color: #CCCCCC;
        }

        &:focus {
            &::placeholder {
                background: transparent;
                color: transparent;
            }

            background: transparent;
        }

        &:hover, &:focus {
            box-shadow: $userManagementRowBoxShadow;
        }
    }
}

.search_btn {
    background: url("../../../../images/icons/search_img.png") no-repeat center / contain;
    width: 36px;
    height: 30px;
    display: block;

    &:hover {
        transform: scale(0.90);
    }
}


.users_management__wrapper {
    padding-top: 10px;
    padding-bottom: 10px;
    background: rgba(251, 251, 251);
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    margin-bottom: 5px;
}


.users_management__add_user, .users_management__edit {
    min-height: 88px;
    align-items: center;
}

.users_management__edit {
    > .row {
        border-left: 2px solid #F5F5F5;
    }

    .row {

        flex-wrap: nowrap;
        height: 100%;
        @media all and (max-width: $breakpoint) {
            flex-wrap: wrap;
            > * {
                padding-top: 5px;
                padding-bottom: 5px;
            }

        }
    }
}

.users_management__add_user {
    display: flex;
    justify-content: center;
}

.add_user__btn {
    background: $designColorOne;
    font-style: normal;
    font-weight: 900;
    font-size: 12px;
    text-align: center;
    text-transform: uppercase;
    color: #FFFFFF;
    border-radius: 4px 4px 0 0;
    min-height: 50px;
    padding-right: 15px;
    padding-left: 15px;
}

.edit__actions_list {
    border-right: 2px solid #F5F5F5;
    justify-content: space-between;

}

.edit__action {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;

    > * {
        width: 30px;
        height: 26px;
        cursor: pointer;
        display: block;
    }
}

.edit_btn {
    background: url("../../../../images/icons/edit_img.png") no-repeat center / contain;

    &[disabled] {
        opacity: 0.5;
    }
}

.remove_btn {
    background: url("../../../../images/icons/delete_img.png") no-repeat center / contain;
}

.setting_btn {
    background: url("../../../../images/icons/setting_img.png") no-repeat center / contain;
}

.paginator_row {
    flex: 1 1 100%
}

.edit__action_checkbox {
    flex: none;
    width: 77.33px;
    max-width: unset;
}

</style>
