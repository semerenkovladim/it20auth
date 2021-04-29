<template>
    <main class="users_management">
        <user-management-settings></user-management-settings>
        <user-management-confirm></user-management-confirm>
        <!--        <div class="temp_header">-->
        <!--            <div class="temp_nav"></div>-->
        <!--        </div>-->
        <div class="container-fluid users_management__container">
            <div class="wrapper col">
                <placeholder :text="placeholderText"
                             :links="links">
                </placeholder>
                <div class="row users_management__row users_management__wrapper">
                    <div class="col-md-3 users_management__col">
                        <div class="users_management__add_user">
                            <button class="add_user__btn" type="button">Добавить пользователя</button>
                        </div>
                        <div class="users_management__users_filter">
                            <ul class="row users_management__filter_list">
                                <li class="col-12 users_management__filter_item filter-active">Все пользователи</li>
                                <li class="col-12 users_management__filter_item">Отдел сайтов</li>
                                <li class="col-12 users_management__filter_item">Отдел разработки проектов</li>
                                <li class="col-12 users_management__filter_item">Отдел дизайна</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 users_management__col users_management__list">
                        <div class="users_management__edit">
                            <div class="row">
                                <div class="col-1 edit__action edit__action_checkbox">
                                    <label>
                                        <input type="checkbox"
                                               class="select_all"
                                               @click="toggleCheckAll"
                                               :checked="checkStatus">
                                    </label>
                                </div>
                                <div class="edit__actions_list">
                                    <ul class="row">
                                        <li class="edit__action">
                                            <button class="edit_btn"
                                                    type="button"
                                                    @click="$router.push('/personal-data')">
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
                        <div class="wrapper"
                             v-if="users.length">
                            <div class="users_management__sort">
                                <ul class="row users_management__sort_list">
                                    <li class="col-1 sort_item"></li>
                                    <li class="col-2 sort_item"><span>Фамилия</span></li>
                                    <li class="col-2 sort_item"><span>Имя</span></li>
                                    <li class="col-2 sort_item"><span>Отчество</span></li>
                                    <li class="col-3 sort_item"><span>E-mail</span></li>
                                    <li class="col-2 sort_item"><span>Должность</span></li>
                                </ul>
                            </div>
                            <ul class="users_management__user_list">
                                <li class="user"
                                    v-for="user in users"
                                    :key="user.id">
                                    <ul class="row user__info">
                                        <li class="col-1 user_info__item user_checkbox">
                                            <label>
                                                <input type="checkbox"
                                                       class="user_check"
                                                       :checked="checkAll"
                                                       @click="toggleCheck">
                                            </label>
                                        </li>
                                        <li class="col-2 user_info__item">{{ user.lastName }}</li>
                                        <li class="col-2 user_info__item">{{ user.firstName }}</li>
                                        <li class="col-2 user_info__item">{{ user.patronymic }}</li>
                                        <li class="col-3 user_info__item">
                                            <a :href="'mailto:' + user.email">{{ user.email }}</a>
                                        </li>
                                        <li class="col-2 user_info__item">{{ user.position }}</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="not_found" v-else>Пользователи не найдены</div>
                    </div>
                </div>
                <div class="row users_management__paginator_row"
                     v-if="users.length">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <div class="row users_management__paginator">
                            <nav aria-label="Page navigation">
                                <ul class="paginator">
                                    <li class="paginator_item paginator__prev"></li>
                                    <li class="paginator_item">1</li>
                                    <li class="paginator_item paginator__current_page">2</li>
                                    <li class="paginator_item">3</li>
                                    <li class="paginator_item">4</li>
                                    <li class="paginator_item paginator__next"></li>
                                </ul>
                            </nav>
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
import {mapActions} from "vuex";

export default {
    name: "UsersManagement",
    components: {
        'placeholder': Placeholder,
        'user-management-settings': UserManagementSettings,
        'user-management-confirm': UserManagementConfirm
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
                    href: '#'
                },
            ],
            users: [
                {
                    id: '1',
                    lastName: 'Макаров',
                    firstName: 'Сергей',
                    patronymic: 'Александрович',
                    email: 'makarov4@gmail.com',
                    position: 'Разработчик'
                },
                {
                    id: '2',
                    lastName: 'Попутько',
                    firstName: 'Николай',
                    patronymic: 'Иванович',
                    email: 'poputkoNik@yahoo.com',
                    position: 'Разработчик'
                },
                {
                    id: '3',
                    lastName: 'Сергеенко',
                    firstName: 'Илья',
                    patronymic: 'Павлович',
                    email: 'effie-guz@yahoo.com',
                    position: 'Верстальщик'
                },
                {
                    id: '4',
                    lastName: 'Зимина',
                    firstName: 'Анна',
                    patronymic: 'Владимировна',
                    email: 'zim@lind.co.uk',
                    position: 'Дизайнер'
                },
                {
                    id: '5',
                    lastName: 'Власова',
                    firstName: 'Оксана',
                    patronymic: 'Николаевна',
                    email: 'barbara-maxwell@hotmail.com',
                    position: 'Менеджер'
                },
                {
                    id: '6',
                    lastName: 'Каширина',
                    firstName: 'Мария',
                    patronymic: 'Алексеева',
                    email: 'thornton@crooks.com',
                    position: 'Аналитик'
                }
            ],
            checkAll: false,
            checkStatus: false
        }
    },
    methods: {
        ...mapActions([
            'changeUMSettingStatus',
            'changeUMConfirmStatus'
        ]),
        toggleCheckAll() {
            this.checkAll = !this.checkAll
        },
        toggleCheck() {
            let checkboxes = document.querySelectorAll('.user_check')
            for (let item of checkboxes) {
                if (!item.checked) {
                    this.checkStatus = false
                    return
                }
            }
        },
        toggleSettings() {
            this.changeUMSettingStatus()
        },
        removeUser() {
            this.changeUMConfirmStatus()
        }
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

.users_management__sort .sort_item, .users_management__user_list .user__info {
    color: $userManagementUserColor;
    border-bottom: 2px solid #F5F5F5;
    font-style: normal;
    font-weight: 500;
}

.users_management__list {
    display: flex;
    flex-direction: column;

    .wrapper {
        padding: 0 15px;
        margin-right: -15px;
        margin-left: -15px;
        overflow-x: auto;
        margin-bottom: 4px;
        border-left: 2px solid #F5F5F5;

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
            padding-right: 10px;
            justify-content: space-between;
            flex-wrap: nowrap;
        }
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

.users_management__user_list {
    min-height: 55px;

    .user {
        &:last-child {
            border-bottom: none;

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

        a {
            color: $lightColor;
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

.users_management__filter_item {
    border-bottom: 2px solid #F5F5F5;
    min-height: 55px;
    align-items: center;
    display: flex;
    cursor: pointer;
    border-left: 2px solid transparent;
    font-weight: 600;
    font-size: 13px;
    color: $lightColor;

    &:first-child {
        border-top: 2px solid #F5F5F5;
    }


    &:hover {
        background: $userManagementFilterActiveBg;
        border-left: 2px solid $designColorOne;
        color: $darkColor;
    }
}

.filter-active {
    background: $userManagementFilterActiveBg;
    border-left: 2px solid $designColorOne;
    color: $darkColor;
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
}

.remove_btn {
    background: url("../../../../images/icons/delete_img.png") no-repeat center / contain;
}

.setting_btn {
    background: url("../../../../images/icons/setting_img.png") no-repeat center / contain;
}

.users_management__paginator {
    background: #FFFFFF;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    border-radius: 6px;

    nav {
        width: 100%;
    }

    .paginator {
        display: flex;
        height: 60px;
    }

    .paginator_item {
        flex: 1 1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
        color: $darkColor;
        width: 100%;
        max-width: 68px;
        cursor: pointer;
        border-right: 2px solid #F5F5F5;

        &:last-child {
            border-right: none;
        }

        &:hover {
            background-color: #FAFAFA;
        }

    }

    .paginator__prev {
        background: url("../../../../images/icons/arow-left.png") no-repeat center / 36px 30px;
    }

    .paginator__next {
        background: url("../../../../images/icons/arrow-rigth.png") no-repeat center / 36px 30px;
    }

    .paginator__current_page {
        background: #FAFAFA;
    }
}

.temp_header, .temp_nav {
    background: #FFFFFF;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 99;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

//
//.temp_header {
//    height: $headerHeight;
//    width: 100%;
//
//}
//
//.temp_nav {
//    height: 100vh;
//    width: $navWidth;
//    @media all and (max-width: $breakpoint) {
//        display: none;
//    }
//}

.edit__action_checkbox {
    flex: none;
    width: 77.33px;
    max-width: unset;
}

</style>
