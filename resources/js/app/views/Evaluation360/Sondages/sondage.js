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
            skills: [],
        }
    },
    mounted() {
    },
    created() {
        this.getSpecificSondage(this.$route.params.sondageId);
        EventBus.$on('next', () => {
            this.e1++
        })
        EventBus.$on('cancel', () => {
            this.e1--
        })

    },
    methods: {
        async getSpecificSondage(sondageId) {
            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/apprenant/sondage/${sondageId}`)
                const reqData = req.data.data;
                if (reqData) {
                    this.sondage = reqData;
                    await this.checkSondage(reqData)
                }
                else {
                    this.$router.push({ name: 'SondagesList' })
                }
            }
            catch (err) {
                console.log(err)
                console.log("creve")
            }
        },
        checkSondage(sondage) {
            if (!_.isEmpty(sondage)) {
                sondage[0].lines.forEach(line => {
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

                console.log(this.questions)
                console.log(this.skills)
                console.log(this.languages)
            }
        }
    }
}