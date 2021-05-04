import Vue from 'vue';
import Vuetify from 'vuetify';
import Router from './router.js';
import Layout from './layouts/Layout.vue';
import 'vuetify/dist/vuetify.min.css';
import _ from 'lodash';
import FlashMessage from '@smartweb/vue-flash-message';
import fr from 'vuetify/src/locale/fr.ts';
import store from './store'

//Editor markdown
// import 'v-markdown-editor/dist/v-markdown-editor.css';
// import Editor from 'v-markdown-editor';

Vue.use(FlashMessage);
Vue.use(Vuetify);
// Vue.use(Editor);

const main = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        lang: {
            locales: { fr },
            current: 'fr',
        },
    }),
    router: Router,
    store,
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
