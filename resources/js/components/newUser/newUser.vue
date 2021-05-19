<template>
    <main class="row users_management new_user">
        <div class="col user_edit__container">
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
                    <UserAccess
                        :data="userData"
                        v-if="UM_SETTINGS_STATUS.personalAccessStatus"
                    @accessUpdate="setUserAccess">
                    </UserAccess>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import Placeholder from "../placeholder/Placeholder";
import UserEditForm from "../UserEdit/components/UserEditForm";
import UserAccess from "../userAccess/UserAccess";
import {mapActions, mapGetters} from "vuex";

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
                avatar: '',
                access_level: {
                    account: 0,
                    disk: 0,
                    mail: 0,
                    contacts: 0,
                    calendar: 0,
                    photo: 0
                }
            }
        }
    },
    methods: {
        ...mapActions([
           'changeUMPersonalDataStatus'
        ]),
        setUserAccess(data) {
            this.userData.access_level = data
            this.changeUMPersonalDataStatus(true)
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
