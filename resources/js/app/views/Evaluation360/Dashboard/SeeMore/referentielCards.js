import { apiService } from '../../../../services/apiService.js';
export default {
    data() {
        return {
            referentiel: []
        }
    },
    created() {
        this.initializeData()
    },
    methods: {
         initializeData() {
           this.$store.dispatch('getReferentiels')
           this.referentiel = this.$store.state.referentiels
        },
    }
}