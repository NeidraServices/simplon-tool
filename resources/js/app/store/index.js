import Vue from 'vue';
import Vuex from 'vuex';
import VuexPersist from 'vuex-persist';
import _ from 'lodash';
import { apiService } from '../services/apiService.js';
Vue.use(Vuex)

const vuexLocal = new VuexPersist({
    storage: window.localStorage
})

export default new Vuex.Store({
    plugins: [vuexLocal.plugin],
    state: {
        isLogged: false,
        apprenants: [],
        apprenant: {},
        langages: [],
        referentiels: []
    },
    mutations: {
        connect(state, payload) {
            state.isLogged = true;
        },
        disconnect(state) {
            state.isLogged = false;
        },
        storeApprenants(state, payload) {
            state.apprenants = payload;
        },
        storeLangages(state, payload) {
            state.langages = payload;
        },
        storeReferentiels(state, payload) {
            state.referentiels = payload;
        },
        Apprenant(state, payload) {
            state.apprenant = payload
        }
    },
    actions: {
        async getApprenants({ state }) {
            if (_.isEmpty(state.apprenants)) {
                try {
                    const req = await apiService.get(`${location.origin}/api/apprenants`)
                    const reqData = req.data.data
                    this.commit('storeApprenants', reqData)
                }
                catch (err) { console.log(err) }
            }
        },
        async getLangages({ state }) {
            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/langage/list`)
                const reqData = req.data.data
                this.commit('storeLangages', reqData)

            }
            catch (err) { console.log(err) }
        },
        async getReferentiels({ state }) {
            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/referentiel/list`)
                const reqData = req.data.data
                this.commit('storeReferentiels', reqData)
            }
            catch (err) { console.log(err) }
        },

    },
    getters: {

    }
})