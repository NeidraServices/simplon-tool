import { EventBus } from '../../../../eventBus.js';
export default {
    props: {
        questions: {
            default: Object
        }
    },
    data() {
        return {
            description: {},
            valid: true,
            lazy: false
        }
    },
    methods: {
        update() {
            this.questions.forEach(_question => {
                if (this.description[_question.id]) {
                    _question.answers = this.description[_question.id]
                }
            })
        },
        next() {
            EventBus.$emit('next')
            EventBus.$emit('sendAnswers', this.questions)
        },
    }
}