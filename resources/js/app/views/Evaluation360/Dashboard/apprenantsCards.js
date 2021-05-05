export default {
    data() {
        return {
            apprenants: []
        }
    },
    created() {
        this.initializeData()
    },
    methods: {
        initializeData() {
            this.$store.dispatch('getApprenants')
            this.apprenants = this.$store.state.apprenants
        },
        getImages(image) {
            return `${location.origin}/images/${image}`
        },
        async goToDetails(apprenant) {
            await this.$store.commit('Apprenant', apprenant)
            await this.$router.push(`details`);
        }
    }

}