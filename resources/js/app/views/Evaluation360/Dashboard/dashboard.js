import ApprenantsCards from './Apprenants/ApprenantsCards.vue';
import { apiService } from '../../../services/apiService.js'
export default {
    components: {
        ApprenantsCards
    },
    data() {
        return {
            isLoading: false,
            apprenants: [],
            apprenant: null,
            search: null
        }
    },

    created() {
        this.getStatus();
        this.getSources();
        this.getContacts();
    },

    watch: {
        apprenant: function (val) {
            if (val == null) {
                this.$store.state.apprenants = [];
                this.$store.dispatch('getApprenants');
            }
        }
    },
    created() {
        this.apprenants = this.$store.state.apprenants
    },

    methods: {
        filter() {
            const filter = this.buildFilter();
            apiService.post('/api/apprenants/filter', filter)
                .then(({ data }) => {
                    data.data.forEach(apprenant => {
                        apprenant.show = true
                    })
                    this.$store.state.apprenants = data.data;
                    this.$emit("input", data);
                })
        },

        buildFilter() {
            let filter = {};

            if (this.apprenant && !_.isEmpty(this.apprenant)) {
                filter['apprenant'] = this.apprenant;
            }
            return filter;
        }
    }
}