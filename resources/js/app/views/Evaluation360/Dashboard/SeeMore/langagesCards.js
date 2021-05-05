export default {
    data() {
        return {
            langages: []
        }
    },
    mounted() {
        this.initializeData()
    },
    methods: {
        initializeData() {
            this.$store.dispatch('getLangages')
            this.langages = this.$store.state.langages
        },
        getImages(image) {
            return `${location.origin}/images/${image}`
        }
    }
}