import Referentiel from './ReferentielCards.vue';
import Langages from './LangagesCards.vue';
import { apiService } from '../../../../services/apiService';

export default {
    components: {
        Referentiel,
        Langages
    },
    data() {
        return {
            apprenant: {},
            notes: [],
            langagesList: [],
            langagesNoted: {},
            Langages: [],
            skills: [],
            referentielsList: [],
        }
    },
    created() {
        this.initializeData()
        this.initializeReferentiel()
        console.log(this.skills)

    },
    methods: {
        async initializeData() {
            try {
                const req = await apiService.get('/api/evaluation360/user/' + this.$route.params.id)
                this.apprenant = req.data.data
            }
            catch (err) { console.log(err) }
            this.$store.dispatch('getLangages');
            this.$store.dispatch('getReferentiels');
            this.langagesList = this.$store.state.langages
            this.referentielsList = this.$store.state.referentiels

        },
        //TODO Matt - A terminer, problème object array
        async initializeReferentiel() {
            try {
                const req = await apiService.get('/api/evaluation360/apprenant/sondage/notes/' + this.$route.params.id)
                this.notes = req.data.data
                var langNote = 0
                var langI = 0
                var refNote = 0
                var refI = 0
                await this.notes.forEach(note => {
                    if (note.sondage_line_id.langage) {
                        this.langagesList.forEach(_langList => {
                            if (note.sondage_line_id.langage.name == _langList.name) {
                                langI++
                                langNote = langNote + note.note
                                this.langagesNoted[note.sondage_line_id.langage.name] = [{ note: Math.floor(langNote / langI), langage: note.sondage_line_id.langage.name }]
                                this.Langages.push({
                                    name: note.sondage_line_id.langage.name,
                                    note: Math.floor(langNote / langI)
                                })
                                _langList['note'] = Math.floor(langNote / langI)
                            }
                        })

                    }
                    else if (note.sondage_line_id.skill) {
                        this.referentielsList.forEach(_referentiel => {
                            _referentiel.competences.forEach(_ref => {
                                if (_ref.description == note.sondage_line_id.skill.description) {
                                    refI++
                                    refNote = refNote + note.note
                                    _ref['note'] = Math.floor(refNote / refI)
                                }
                            })
                        })
                    }
                });
            }
            catch (err) { console.log(err) }
        },
    }
}