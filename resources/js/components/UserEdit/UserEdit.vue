<template>
    <main class="row users_management">
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
import UserEditForm from "./components/UserEditForm";
import UserAccess from "../userAccess/UserAccess";
import {mapGetters} from "vuex";

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
                    href: '#'
                },
                {
                    id: 2,
                    name: 'Пользователи',
                    href: '#'
                },
                {
                    id: 3,
                    name: 'Попутько Николай Иванович',
                    href: '#'
                },
                {
                    id: 4,
                    name: 'Персональные данные',
                    href: '#'
                },
            ],
            text: 'Редактирование пользователя',
            placeholderNav: true,
            userData: {}
        }
    },
    methods: {
        getUser() {
            return axios.get('/api/user/' + this.$route.query.id)
                .then(value => {
                    this.userData = value.data.data
                    console.log(value)
                    console.log('this.userData', this.userData)
                })
                .catch(reason => {
                    // console.log(reason)
                })
        }
    },
    computed: {
        ...mapGetters([
            'UM_SETTINGS_STATUS'
        ])
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
