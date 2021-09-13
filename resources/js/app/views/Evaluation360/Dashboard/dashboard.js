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
            search: null,
            note: null
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
            apiService.post('/api/evaluation360/apprenants/filter', filter)
                .then(({ data }) => {
                    data.data.forEach(apprenant => {
                        apprenant.show = true;
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
                    })
                    this.$store.state.apprenants = data.data;
                    this.$emit("input", data);
                })
        },

        allApprenant() {
            this.$store.dispatch('getApprenants');

        },

        buildFilter() {
            let filter = {};

            if (this.apprenant && !_.isEmpty(this.apprenant)) {
                filter['apprenant'] = this.apprenant;
            }
            if (this.note) {
                console.log(this.note)
                filter['note'] = this.note;

            }
            return filter;
        }
    }
}