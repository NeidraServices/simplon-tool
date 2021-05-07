import { EventBus } from "../../../../eventBus"

export default {
    data() {
        return {
            commentaire: ''
        }
    },
    methods: {
        send() {
            EventBus.$emit('sendSondage', this.commentaire)
        },
        cancel() {
            EventBus.$emit('cancel')
        }
    }
}