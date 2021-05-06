<template>
    <main class="row users_management new_user">
        <div class="container-fluid users_management__container user_edit__container">
            <div class="wrapper col">
                <Placeholder :links="links"
                             :text="text"
                             :placeholder-nav="placeholderNav">
                </Placeholder>
                <div class="row user_edit_form__wrapper">
                    <UserEditForm
                        :data="userData"
                        v-if="UM_SETTINGS_STATUS.personalDataStatus">
                    </UserEditForm>
                    <UserAccess v-if="UM_SETTINGS_STATUS.personalAccessStatus"></UserAccess>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import Placeholder from "../placeholder/Placeholder";
import UserEditForm from "../UserEdit/components/UserEditForm";
import UserAccess from "../userAccess/UserAccess";
import {mapGetters} from "vuex";

export default {
    name: "newUser",
    components: {
        Placeholder,
        UserEditForm,
        UserAccess
    },
    data() {
        return {
            text: 'Добавить нового пользователя',
            placeholderNav: true,
            links: [
                {
                    id: 1,
                    name: 'Управление ',
                    href: '#'
                },
                {
                    id: 2,
                    name: 'Пользователи',
                    href: '/users-management'
                },
                {
                    id: 3,
                    name: 'Новый пользователь',
                    href: '/users-management/new-user'
                },
            ],
            userData: {
                avatar:''
            }
        }
    },
    computed: {
        ...mapGetters([
            'UM_SETTINGS_STATUS'
        ])
    }
}
</script>

<style scoped>

</style>
