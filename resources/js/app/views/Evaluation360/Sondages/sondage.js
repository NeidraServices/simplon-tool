import Languages from './StepperContent/Languages.vue';
import Questions from './StepperContent/Questions.vue';
import Commentaires from './StepperContent/Commentaires.vue';
import Skills from './StepperContent/Skills.vue';
import { EventBus } from '../../../eventBus';
import { apiService } from '../../../services/apiService.js';
export default {
    components: {
        Languages,
        Questions,
        Commentaires,
        Skills
    },
    data() {
        return {
            e1: 1,
            sondage: null,
            questions: [],
            languages: [],
            skills: []
        }
    },
    mounted() {
        this.initializeData()
        this.checkSondage()
    },
    created() {
        EventBus.$on('sendAnswers', data => {
            this.questions = data
        })
        EventBus.$on('sendLangNotes', data => {
            this.languages = data
        })
        EventBus.$on('sendSkillsNote', data => {
            this.skills = data
        })
        EventBus.$on('sendSondage', data => {
            let newArray = []
            newArray = newArray.concat(this.questions, this.languages, this.skills)
            this.sondage.lines = newArray
            apiService.post('/api/evaluation360/apprenant/sondage/1/answer', this.sondage).then(response => {
                if (response.status == 200) {
                    EventBus.$emit('snackbar', {
                        snackbar: true,
                        text: `Merci d'avoir répondu au sondage`,
                        color: 'blue',
                        timeout: 3000
                    })
                }
                else {
                    EventBus.$emit('snackbar', {
                        text: `Erreur`,
                        color: 'red',
                        timeout: 3000
                    })
                }
            });

        })
        EventBus.$on('next', () => {
            this.e1++
        })
        EventBus.$on('cancel', () => {
            this.e1--
        })

    },
    methods: {
        initializeData() {
            this.$store.dispatch({
                type: 'getSpecificSondage',
                ids: {
                    userId: this.$route.params.userId,
                    sondageId: this.$route.params.sondageId
                }
            })
            this.sondage = this.$store.state.specificSondage
        },
        checkSondage() {
            this.sondage.lines.forEach(line => {
                if (line.question) {
                    this.questions.push(line)
                }
                else if (line.skill) {
                    this.skills.push(line)
                }
                else if (line.langage) {
                    this.languages.push(line)
                }
            })
        }
    }
}