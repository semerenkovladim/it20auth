<template>
    <main class="row users_management">
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
                        @accessUpdate="setUserAccess"></UserAccess>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import Placeholder from "../placeholder/Placeholder";
import UserEditForm from "./components/UserEditForm";
import UserAccess from "../userAccess/UserAccess";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "UserEdit",
    components: {
        Placeholder,
        UserEditForm,
        UserAccess
    },
    data() {
        return {
            links: [
                {
                    id: 1,
                    name: 'Управление ',
                    href: '/users-management',
                    status: true
                },
                {
                    id: 2,
                    name: 'Пользователи',
                    href: '/users-management',
                    status: true
                },
                {
                    id: 3,
                    name: '',
                    href: '#',
                    status: true
                }
            ],
            text: 'Редактирование пользователя',
            placeholderNav: true,
            userData: {
                access_level: {
                    account: 0,
                    disk: 0,
                    mail: 0,
                    contacts: 0,
                    calendar: 0,
                    photo: 0
                }
            },
            userName: ''
        }
    },
    methods: {
        ...mapActions([
            'changeUMPersonalAccess',
            'changeUMPersonalDataStatus'
        ]),
        setUserAccess(data) {
            this.userData.access_level = data
            this.changeUMPersonalAccess(false)
            this.changeUMPersonalDataStatus(true)

        },
        getUser() {
            return axios.get('/api/user/' + this.$route.query.id)
                .then(value => {
                    this.userData = value.data.data
                    if (!value.data.data.access_level) this.userData.access_level = {
                        account: 0,
                        disk: 0,
                        mail: 0,
                        contacts: 0,
                        calendar: 0,
                        photo: 0
                    }

                    this.setUserName()
                })
                .catch(reason => {

                })
        },
        setUserName() {
            let fio = []
            if (this.userData.surname) fio.push(this.userData.surname)
            if (this.userData.name) fio.push(this.userData.name)
            if (this.userData.middle_name) fio.push(this.userData.middle_name)
            this.links[2].name = `${fio.join(' ')}`
        }
    },
    computed: {
        ...mapGetters([
            'UM_SETTINGS_STATUS',
        ]),

    },
    mounted() {
        this.getUser()
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.user_edit_form__wrapper {
    background: #FFFFFF;
    box-shadow: $userManagementRowBoxShadow;
    border-radius: $userManagementRowBorderRadius;

    * {
        transition: 0.2s ease;
    }
}

.user_edit__container {
    padding-bottom: 30px;
}

</style>
