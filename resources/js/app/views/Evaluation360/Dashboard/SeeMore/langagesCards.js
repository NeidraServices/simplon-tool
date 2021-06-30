export default {
    props: {
        langues: {
            default: Object
        }
    },
    mounted(){
        console.log(this.langues)
    },
    methods: {
        getImages(image) {
            return `${location.origin}/images/${image}`
        }
    }
}