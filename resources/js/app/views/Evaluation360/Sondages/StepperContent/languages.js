import { EventBus } from '../../../../eventBus.js';
import ProgressBar from './LanguagesProgressBar';
export default {
    components: {
        ProgressBar,
    },
    props: {
        Languages: {
            default: Array
        }
    },
    data() {
        return {
        }
    },
    mounted() {
        EventBus.$on('changeLangNote', data => {
            this.Languages.forEach(lang => {
                if (lang.langage.id == data['id']) {
                    lang.note = data['note']
                }
            })
        })
    },
    methods: {
        next() {
            EventBus.$emit('next')
            EventBus.$emit('sendLangNotes', this.Languages)
        },
        cancel(){
            EventBus.$emit('cancel')
        }
    }
}