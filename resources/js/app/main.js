import Vue from 'vue';
import Vuetify from 'vuetify';
import Router from './router.js';
import Layout from './layouts/Layout.vue';
import 'vuetify/dist/vuetify.min.css';
import _ from 'lodash';
import FlashMessage from '@smartweb/vue-flash-message';
import fr from 'vuetify/src/locale/fr.ts';

Vue.use(FlashMessage);
Vue.use(Vuetify);

const main = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        lang: {
            locales: { fr },
            current: 'fr',
        },
    }),
    router: Router,
    components: { Layout }
})

Vue.component('my-component', {
    methods: {
        changeLocale() {
            this.$vuetify.lang.current = 'fr'
        },
    },
})

export default new Vuetify(main);