export default {
    data() {
        return {
            note: 0,
            displayNote: 0,
        }
    },
    methods: {
        updateNote() {
            if (this.note < 0) {
                this.note = 0
            } else if (this.note > 100) {
                this.note = 100
            }
            this.note = Math.floor(this.note)
            this.displayNote = Math.floor(this.note / 10)

        },
        getImages(image) {
            return `${location.origin}/images/${image}`
        },
    }
}