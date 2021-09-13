import { apiService } from "../../../../services/apiService";

export default {

    created() {
        this.initializeData()
    },
    methods: {
        getSondages() {

        },

        initializeData() {
            this.$store.dispatch('getApprenants')
            this.$store.state.apprenants

        },
        getImages(image) {
            return `${location.origin}/images/${image}`
        },
        async goToDetails(apprenant) {
            await this.$store.commit('Apprenant', apprenant)
            await this.$router.push(`/user/` + apprenant.id);
        }
    }

}