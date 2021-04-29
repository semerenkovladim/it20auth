import Vue from 'vue'
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        count: 0,
        usersManagement: {
            settingStatus: false,
            confirmStatus:false,
            confirm:false
        },
        user: {},
        access_token: '',
        refresh_token: '',
    },
    mutations: {
        increment(state) {
            state.count++
        },
        setUMSettingStatus(state) {
            state.usersManagement.settingStatus = !state.usersManagement.settingStatus
        },
        setUMConfirmStatus(state) {
            state.usersManagement.confirmStatus = !state.usersManagement.confirmStatus
        },
        setUMConfirm(state) {
            state.usersManagement.confirm = !state.usersManagement.confirm
        },
        setUser(state, user) {
            state.user = user;
        },
        setAccessToken(state, access_token) {
            state.access_token = access_token;
        },
        setRefreshToken(state, refresh_token) {
            state.refresh_token = refresh_token;
        }
    },
    actions: {
        async changeUMSettingStatus({commit}) {
            commit('setUMSettingStatus')
        },
        async changeUMConfirmStatus({commit}) {
            commit('setUMConfirmStatus')
        },
        saveUserFromServer({commit}, user) {
            commit('setUser', user);
        },
        saveAccessFromServer({commit}, access_token) {
            commit('setAccessToken', access_token);
        },
        saveRefreshFromServer({commit}, refresh_token) {
            commit('setRefreshToken', refresh_token);
        }
    },
    getters: {
        UM_SETTINGS_STATUS(state) {
            return state.usersManagement
        },
        user(state) {
            return state.user;
        },
        access_token(state) {
            return state.access_token;
        },
        refresh_token(state) {
            return state.refresh_token;
        }
    },

    plugins: [createPersistedState()],
})


export default store
