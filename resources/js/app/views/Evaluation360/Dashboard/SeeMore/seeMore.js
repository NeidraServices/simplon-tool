import Referentiel from './ReferentielCards.vue';
import Langages from './LangagesCards.vue';

export default {
    components: {
        Referentiel,
        Langages
    },
    data() {
        return {
            apprenant: this.$store.state.apprenant
        }
    },
    mounted() {
    },
}