import { EventBus } from "../eventBus"

export default {
    data: () => ({
        snackbar: false,
        timeout: -1,
        text: ``,
        color: ``
    }),
    created() {
        EventBus.$on('snackbar', data => {
            this.snackbar = true
            this.timeout = data.timeout
            this.text = data.text
            this.color = data.color
        })
    }
}