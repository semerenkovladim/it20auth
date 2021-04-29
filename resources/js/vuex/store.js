import Vue from 'vue'
import Vuex from "vuex";
Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        count: 0,
        usersManagement: {
            settingStatus: false,
            confirmStatus:false,
            confirm:false
        }
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
        }
    },
    actions: {
        async changeUMSettingStatus({commit}) {
            commit('setUMSettingStatus')
        },
        async changeUMConfirmStatus({commit}) {
            commit('setUMConfirmStatus')
        }
    },
    getters: {
        UM_SETTINGS_STATUS(state) {
            return state.usersManagement
        }
    }
})


export default store
