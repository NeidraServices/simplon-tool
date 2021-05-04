import Vue from 'vue';
import Vuex from 'vuex';
import VuexPersist from 'vuex-persist';
import _ from 'lodash';

Vue.use(Vuex)

const vuexLocal = new VuexPersist({
    storage: window.localStorage
})

export default new Vuex.Store({
    plugins: [vuexLocal.plugin],
    state: {
        isLogged: false,
        userRole: null,
        userId: null,
    },
    mutations: {
        connect(state, payload) {
            state.isLogged = true;
            state.userRole = payload.role;
            state.userId   = payload.userId;
        },
        disconnect(state) {
            state.isLogged = false;
            state.userRole = null;
            state.userId   = null;
        },
    },
    actions: {
      
    },
    getters: {

    }
})