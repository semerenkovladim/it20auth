<template>
    <main class="row users_management" v-if="tempUser.is_admin">
        <user-management-settings :data="tempSettings"></user-management-settings>
        <user-management-confirm
            v-if="UM_SETTINGS_STATUS.confirmStatus"
            @deleteEvent="deleteSelectUsers"
            :userDataLength="selectUsers.length">
        </user-management-confirm>
        <div class="col">
            <div class="wrapper col">
                <placeholder :text="placeholderText"
                             :links="links">
                </placeholder>
                <div class="row users_management__row users_management__wrapper">
                    <div class="col-md-3 users_management__col department_col">
                        <div class="users_management__add_user">
                            <button class="add_user__btn" type="button"
                                    @click="$router.push('/users-management/new-user')">Добавить пользователя
                            </button>
                        </div>
                        <div class="users_management__users_filter">
                            <department-list :data="departments"
                                             :currentDep="currentDepartment"
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
                                               :class="0 < usersCount ? 'middle_position':''"
                                               @change="changeSelectAll"
                                               v-model="checkAll">
                                    </label>
                                </div>
                                <div class="edit__actions_list">
                                    <ul class="row flex-nowrap">
                                        <li class="edit__action">
                                            <button class="edit_btn"
                                                    type="button"
                                                    @click="$router.push({
                                                        path:'/users-management/user-edit',
                                                        query:{id:selectUsers[0].id}
                                                    })"
                                                    :disabled="selectUsers.length !==1">
                                            </button>
                                        </li>
                                        <li class="edit__action">
                                            <button class="remove_btn"
                                                    type="button"
                                                    @click="removeUser"
                                                    :disabled="selectUsers.length === 0">
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
                                <form action="#"
                                      method="get"
                                      class="search_user"
                                      autocomplete="off"
                                      @submit.prevent="searchUser(searchInput)">
                                    <div class="row search__row flex-nowrap">
                                        <label class="col-10">
                                            <input type="search"
                                                   name="search"
                                                   placeholder="Поиск"
                                                   v-model="searchInput">
                                        </label>
                                        <button class="col-2 search_btn"
                                                type="button"
                                                @click="searchUser(searchInput)"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <users-management-list
                            v-if="usersData.data"
                            :data="usersData.data"
                            :checkStatus="checkStatus"
                            :settings="tempSettings"
                            :notFoundMessage="notFoundUsers"
                            @allChecked="setAllCheck"
                            @changeUsersLength="userCount"
                            @orderEvent="setOrder">
                        </users-management-list>
                    </div>
                </div>
                <div class="row users_management__paginator_row"
                     v-if="usersData">
                    <div class="col-md-3"></div>
                    <div class="col-md-9" v-if="usersData.last_page > 1">
                        <div class="row paginator_row">
                            <paginator :data="usersData"
                                       :data_id="currentDepartment"
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
            usersData: {
                data: []
            },
            departments: {},
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
            checkAll: false,
            checkStatus: false,
            usersCount: 0,
            selectUsers: [],
            currentDepartment: 0,
            currentPage: 1,
            tempUser: {
                is_admin: true
            },
            tempSettings: [],
            order: 'id',
            desc: false,
            searchInput: '',
            searchStatus: false,
            notFoundUsers: 'Пользователи не найдены'

        }
    },
    methods: {
        ...mapActions([
            'changeUMSettingStatus',
            'changeUMConfirmStatus',
            'getUMMessage',
            'getAllDepartments'

        ]),
        setOrder(data) {
            this.order = data.order
            this.desc = data.desc
            this.getUsers()
        },
        changeSelectAll() {
            for (let user in this.usersData.data) {
                this.usersData.data[user].checked = this.checkAll;
                if (this.checkAll) {
                    if (this.selectUsers.findIndex(x => x.id === this.usersData.data[user].id) === -1) this.selectUsers.push(this.usersData.data[user])
                } else {
                    this.selectUsers.length = 0
                    this.usersCount = 0
                }
            }
            this.usersCount = this.selectUsers.length
            this.checkStatus = !this.checkStatus

        },
        async getUMAllUsers(page = 1, orderBy = 'id', desc = false) {
            axios.get('/api/users', {
                params: {
                    page: page,
                    orderBy: orderBy,
                    desc: desc
                }
            })
                .then(value => {
                        this.usersData = value.data.data
                    }
                )
                .catch(reason => {
                        this.getUMMessage(reason)
                    }
                )
        },
        async getUsersInDepartment(data = {
            id: 1,
            page: 1,
            orderBy: 'id',
            desc: false
        }) {
            axios.get('/api/users/' + data.id, {
                params: {
                    page: data.page,
                    orderBy: data.orderBy,
                    desc: data.desc
                }
            })
                .then(value => {
                    this.usersData = value.data.data
                })
                .catch(reason => {
                    this.getUMMessage(reason)
                })
        },
        async deleteSelectUsers() {
            if (this.selectUsers) {
                let usersId = []
                for (let item in this.selectUsers) {
                    usersId.push(this.selectUsers[item].id)
                }
                axios.post('/api/users/delete', {
                    data: usersId
                })
                    .then(value => {
                        if (value.status) {
                            this.changeUMConfirmStatus()
                            this.checkAll = false
                            this.getUsers()
                        }

                        // this.getUMMessage(value)
                    })
                usersId.length = 0
                this.selectUsers.length = 0
                this.usersCount = 0
            }
        },
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
            if (this.usersData.last_page >= data.page >= 1) {
                this.currentPage = data.page
            }
            if (!this.searchStatus) {
                this.getUsers()
            }
            if (this.searchStatus) {
                this.searchUser(this.searchInput, this.currentPage)
            }

        },
        getUsers() {
            if (this.currentDepartment > 0) {
                this.getUsersInDepartment({
                    id: this.currentDepartment,
                    page: this.currentPage,
                    orderBy: this.order,
                    desc: this.desc
                })
            } else {
                this.getUMAllUsers(this.currentPage, this.order, this.desc)
            }
        },
        getAdminSettings() {
            axios.get('/api/admin-settings/1')
                .then(value => {
                    this.tempSettings = value.data.data
                })
        },
        searchUser(data, page) {
            this.currentDepartment = -1
            if (data.length) {
                return axios.get('/api/users-search', {
                    params: {
                        data: data,
                        page: page
                    }
                })
                    .then(value => {
                        if (value.data.status) this.usersData = value.data.data
                        this.searchStatus = true
                        if (value.data.data.data.length < 1) {
                            this.notFoundUsers = 'По данному запросу записей не найдено'

                        }
                    })
            }
        }
    },
    computed: {
        ...mapGetters([
            'UM_USERS',
            'UM_SETTINGS_STATUS',
            'user'
        ]),
        checkSelectAll() {
            return this.checkAll
        },
        setStatus() {
            return this.setStatus
        },
    },
    created() {
        if (this.user) {
            if (!this.user.is_admin) {
                this.$router.push('/home')
                return
            }
        } else {
            this.$router.push('/login')
            return
        }
        this.getAdminSettings()
        this.getUMAllUsers()
        this.getAllDepartments()

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

.users_management {
    padding-bottom: 15px;
    padding-top: 0;
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
        -webkit-appearance: textfield;

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

.users_management__add_user {
    border-bottom: 2px solid #F5F5F5;
}

.users_management__edit {
    > .row {
        border-bottom: 2px solid #F5F5F5;
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

        &[disabled] {
            opacity: 0.5;
        }
    }
}

.edit__action_checkbox {
    justify-content: flex-start;

    label {
        padding-left: 15px;
    }
}

.edit_btn {
    background: url("../../../../images/icons/edit_img.png") no-repeat center / contain;
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
}

.department_col {
    border-right: 2px solid #F5F5F5;
    display: flex;
    flex-direction: column;
    padding: 0;
    min-height: 400px;
}

.users_management__users_filter {
    overflow-y: auto;
    overflow-x: hidden;
    position: relative;
    min-height: 385px;

    &::-webkit-scrollbar {
        width: 5px;
        cursor: pointer;
        background: transparent;

        &:hover {
            width: 6px;
        }
    }

    &::-webkit-scrollbar {
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
}

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:active,
input:-webkit-autofill:focus {
    background-color: #FFFFFF !important;
    color: $lightColor !important;
    -webkit-text-fill-color: darken($lightColor, 15%) !important;
}
</style>
