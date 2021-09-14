export default {
    props: {
        list: {
            default: Object
        },
    },
    methods: {
        getImages(image) {
            return `${location.origin}/images/${image}`
        }
    }
}