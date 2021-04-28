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
            console.log('setUMSettingStatus', state.usersManagement.confirmStatus)
            state.usersManagement.confirmStatus = !state.usersManagement.confirmStatus
        },
        setUMConfirm(state) {
            state.usersManagement.confirm = !state.usersManagement.confirm
        }
    },
    actions: {
        async changeUMSettingStatus({commit}) {
            console.log('changeUMSettingStatus')
            commit('setUMSettingStatus')
        },
        async changeUMConfirmStatus({commit}) {
            console.log('changeUMConfirmStatus')
            commit('setUMSettingStatus')
        },
        test() {
            console.log('test')
        }
    },
    getters: {
        UM_SETTINGS_STATUS(state) {
            return state.usersManagement
        }
    }
})


export default store
