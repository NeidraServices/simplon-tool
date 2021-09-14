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
            referentielsList: [],
            notedReferentiel: [],
            LangFinalTab: [],
            RefFinalTab: []
        }
    },
    created() {
        this.initializeData()
        this.initializeNote()
        this.$store.dispatch('getLangages');
        this.$store.dispatch('getReferentiels');
        this.langagesList = this.$store.state.langages
        this.referentielsList = this.$store.state.referentiels
    },
    methods: {
        async initializeData() {
            try {
                const req = await apiService.get('/api/evaluation360/user/' + this.$route.params.id)
                this.apprenant = req.data.data
            }
            catch (err) { console.log(err) }
        },
        //TODO Matt - A terminer, problème object array
        async initializeNote() {
            try {
                const req = await apiService.get('/api/evaluation360/apprenant/sondage/notes/' + this.$route.params.id)
                this.notes = req.data.data
                this.evaluateLanguages(this.notes)
                this.evaluateReferentiel(this.notes)
            }
            catch (err) { console.log(err) }
        },
        evaluateReferentiel(notes) {
            let noteArray = []
            notes.forEach(_note => {
                if (_note.sondage_line_id.skill != null) {
                    noteArray.push(_note)
                }
            })
            this.referentielsList.forEach(referentiel => {
                let initialPush = {
                    name: referentiel.description,
                    competences: [],
                    moyenne: 0,
                }
                referentiel.competences.forEach(_ref => {
                    let noteResult = 0;
                    let note = noteArray.filter(_note => _note.sondage_line_id.skill.description == _ref.description)
                    note.forEach(_note => {
                        noteResult += _note.note
                    })
                    initialPush.competences.push({
                        id: _ref.id,
                        description: _ref.description,
                        note: (noteResult / note.length).toFixed(2)
                    })
                    if (!isNaN(parseFloat((noteResult / note.length).toFixed(2)))) {
                        initialPush.moyenne += parseFloat((noteResult / note.length).toFixed(2))
                    }
                })
                var notNan = initialPush.competences.filter(_note => !isNaN(_note.note))
                initialPush.moyenne = (initialPush.moyenne / notNan.length).toFixed(2)

                this.RefFinalTab.push(initialPush)
            })
        },
        evaluateLanguages(notes) {
            let noteArray = []
            notes.forEach(_note => {
                if (_note.sondage_line_id.langage != null) {
                    noteArray.push(_note)
                }
            })
            this.langagesList.forEach(langage => {
                let noteResult = 0;
                let note = noteArray.filter(_note => _note.sondage_line_id.langage.name == langage.name)
                note.forEach(_note => {
                    noteResult += _note.note
                })
                this.LangFinalTab.push({
                    id: langage.id,
                    image: langage.image,
                    name: langage.name,
                    note: (noteResult / note.length).toFixed(2)
                })
            })
        }
    }
}