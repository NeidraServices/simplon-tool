export default {
    data() {
        return {
            sondages: []
        }
    },
    mounted() {
        this.$store.dispatch('getSondages')
        this.sondages = this.$store.state.sondages
    }
}