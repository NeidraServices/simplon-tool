import { apiService } from '../../../../services/apiService.js';
export default {
    props: {
        apprenant: {
            default: Object
        },
        referentielsList: {
            default: Array
        }
    },
    data() {
        return {
            referentiel: []
        }
    },
    created() {
        this.initializeData()
        this.checkNotes()
    },
    methods: {
        initializeData() {
            this.$store.dispatch('getReferentiels')
            this.referentiel = this.$store.state.referentiels
        },
        checkNotes() {
            
        }
    }
}