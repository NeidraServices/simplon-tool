export default {
    data() {
        return {

        }
    },
    methods: {
        getImages(image) {
            return `${location.origin}/images/${image}`
        }
    }
}