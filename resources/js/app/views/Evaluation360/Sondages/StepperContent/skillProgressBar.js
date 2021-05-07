import { EventBus } from "../../../../eventBus"

export default {
    props: {
        skill: {
            default: {}
        }
    },
    data() {
        return {
            skillNote: 0,
            displayNote: 0
        }
    },
    methods: {
        updateNote() {
            if (this.skillNote < 0) {
                this.skillNote = 0
            } else if (this.skillNote > 100) {
                this.skillNote = 100
            }
            this.skillNote = Math.floor(this.skillNote)
            this.displayNote = Math.floor(this.skillNote / 10)
            EventBus.$emit('changeSkillNote', { id: this.skill.id, skillNote: this.displayNote })
        },
    }
}