import Vue from 'vue'
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
import department from "./modules/department"

Vue.use(Vuex)

const API_LINK = '/api'
const USERS_LINK = API_LINK + '/users'

const store = new Vuex.Store({
    state: {
        count: 0,
        usersManagement: {
            settingStatus: false,
            confirmStatus: false,
            confirm: false,
            personalDataStatus: false,
            personalAccessStatus: false
        },
        UMMessage: {
            data: '',
            status: false,
            show: false
        },
        usersList: [],
        user: {},
        access_token: '',
        refresh_token: '',
        resetPasswordEmail: ''

    },
    mutations: {
        increment(state) {
            state.count++
        },
        //управление пользователями
        setUMSettingStatus(state) {
            state.usersManagement.settingStatus = !state.usersManagement.settingStatus
        },
        setUMConfirmStatus(state) {
            state.usersManagement.confirmStatus = !state.usersManagement.confirmStatus
        },
        setUMConfirm(state) {
            state.usersManagement.confirm = !state.usersManagement.confirm
        },
        setUMPersonalDataStatus(state, status) {
            state.usersManagement.personalDataStatus = status
            state.usersManagement.personalAccessStatus = !status
        },
        setUMPersonalAccess(state, status) {
            state.usersManagement.personalAccessStatus = status
            state.usersManagement.personalDataStatus = !status
        },
        setUMUsers(state, users) {
            state.usersList = users
        },
        setUMMessage(state, message) {
            state.UMMessage.data = message.data.error
            state.UMMessage.status = message.data.status
            state.UMMessage.show = true
            console.log('message', message)
        },
        hideUMMessage(state) {
            state.UMMessage.show = false
        },
        //отделы
        setAllDepartments(state, data) {
            state.departments = data
        },
        //
        setUser(state, user) {
            state.user = user;
        },
        setAccessToken(state, access_token) {
            state.access_token = access_token;
        },
        setRefreshToken(state, refresh_token) {
            state.refresh_token = refresh_token;
        },
        setResetPasswordEmail(state, resetPasswordEmail) {
            state.resetPasswordEmail = resetPasswordEmail;
        }
    },
    actions: {
        //управление пользователями
        getUMMessage({commit}, message) {
            commit('setUMMessage', message)
        },
        hideUMMessage({commit}) {
            commit('hideUMMessage')
        },
        async changeUMSettingStatus({commit}) {
            commit('setUMSettingStatus')
        },
        async changeUMConfirmStatus({commit}) {
            commit('setUMConfirmStatus')
        },
        async getUMAllUsers({commit}, page = 1) {
            axios.get(USERS_LINK, {
                params: {
                    page: page
                }
            })
                .then(value => {
                        commit('setUMUsers', value.data.data)
                    }
                )
                .catch(reason => {
                        this.getUMMessage(reason)
                    }
                )
        },
        async getUsersInDepartment({commit}, data = {id: 1, page: 1}) {
            return axios.get('/api/users/' + data.id, {
                params: {
                    page: data.page
                }
            })
                .then(value => {
                    commit('setUMUsers', value.data.data)
                })
                .catch(reason => {
                    this.getUMMessage(reason)
                })
        },
        changeUMPersonalDataStatus({commit}, status) {
            commit('setUMPersonalDataStatus', status)
        },
        changeUMPersonalAccess({commit}, status) {
            commit('setUMPersonalAccess', status)
        },
        //отделы
        async getAllDepartments({commit}) {
            return axios.get('/api/departments/all')
                .then(value => {
                    commit('setAllDepartments', value.data)
                })
                .catch(reason => {
                    console.log('getAllDepartments --- ошибка ---')
                })
        },
        //редактирование пользователя
        async getProfile({commit}, id){
            return axios.get(`/api/profile/${id}`)
                .then(response => {
                    commit('setUser', response.data.data)
                })
        },
        //
        saveUserFromServer({commit}, user) {
            console.log(user);
            commit('setUser', user);
        },
        saveAccessFromServer({commit}, access_token) {
            commit('setAccessToken', access_token);
        },
        saveRefreshFromServer({commit}, refresh_token) {
            commit('setRefreshToken', refresh_token);
        },
        saveResetPasswordEmail({commit}, resetPasswordEmail) {
            commit('setResetPasswordEmail', resetPasswordEmail);
        }
    },
    getters: {
        //управление пользователями
        UM_MESSAGE(state) {
            return state.UMMessage
        },
        UM_SETTINGS_STATUS(state) {
            return state.usersManagement
        },
        UM_USERS(state) {
            return state.usersList
        },
        //отделы
        ALL_DEPARTMENTS(state) {
            return state.departments
        },
        //
        user(state) {
            return state.user;
        },
        access_token(state) {
            return state.access_token;
        },
        refresh_token(state) {
            return state.refresh_token;
        },
        resetPasswordEmail(state) {
            return state.resetPasswordEmail;
        }
    },

    plugins: [createPersistedState()],
    modules: {
        department,
    },
})


export default store
