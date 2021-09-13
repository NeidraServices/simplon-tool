export default {
    props: {
        langues: {
            default: Object
        },
    },
    methods: {
        getImages(image) {
            return `${location.origin}/images/${image}`
        }
    }
}