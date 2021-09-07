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
        userInfo: null,
        apprenants: [],
        apprenant: {},
        langages: [],
        referentiels: [],
        sondages: [],
        specificSondage: {}
    },
    mutations: {
        connect(state, payload) {
            state.isLogged = true;
            state.userInfo = payload.informations
        },
        disconnect(state) {
            state.isLogged = false;
            state.informations = null;
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
        },
        storeSondages(state, payload) {
            state.sondages = payload
        },
        storeSpecificSondage(state, payload) {
            state.specificSondage = payload
        }
    },
    actions: {
        async getApprenants({ state }) {

            // if (_.isEmpty(state.apprenants)) {

            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/apprenants`)
                const reqData = req.data.data
                reqData.forEach(apprenant => {
                    apprenant['note'] = null;
                    apiService.get('/api/evaluation360/apprenant/sondage/' + apprenant.id).then(({ data }) => {
                        if (data.data.length > 0) {
                            let sondages_notes = [];
    
                            data.data.forEach(sondage => {
                                sondages_notes.push(sondage.global_note)
                            });
                            var note_global = _.sum(sondages_notes) / data.data.length;
                            note_global = note_global.toFixed(0);
                            apprenant['note'] = note_global;
                        }
                    })
                });
                this.commit('storeApprenants', reqData)
            }
            catch (err) { console.log(err) }
            // }
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
        async getSondages({ state }) {
            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/apprenant/sondage/list`)
                const reqData = req.data.data
                this.commit('storeSondages', reqData)
            }
            catch (err) { console.log(err) }
        },
        async getSpecificSondage({ state }, data) {
            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/apprenant/sondage/${data.ids.userId}/${data.ids.sondageId}`)
                const reqData = req.data.data
                this.commit('storeSpecificSondage', reqData)
            }
            catch (err) {
                this.commit('storeSpecificSondage', {})
            }
        },

    },
    getters: {

    }
})