export default {
   

    created() {
        this.initializeData()
    },
    methods: {
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