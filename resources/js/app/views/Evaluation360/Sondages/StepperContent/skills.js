import { EventBus } from '../../../../eventBus';
import ProgressBar from './SkillProgressBar';
export default {
    components: {
        ProgressBar
    },
    props: {
        skills: {
            default: Object
        }
    },
    created() {
        EventBus.$on('changeSkillNote', data => {
            this.skills.forEach(skill => {
                if (skill.skill.id == data['id']) {
                    skill.note = data['skillNote']
                }
            })
        })
    },
    methods: {
        next() {
            EventBus.$emit('next')
            EventBus.$emit('sendSkillsNote', this.skills)
        },
        cancel() {
            EventBus.$emit('cancel')
        }
    }
}