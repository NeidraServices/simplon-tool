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
            skills: []
        }
    },
    created() {
        this.initializeData()
        // this.initializeReferentiel()
    },
    methods: {
        async initializeData() {
            try {
                const req = await apiService.get('/api/user/1')
                this.apprenant = req.data.data
            }
            catch (err) { console.log(err) }
            this.$store.dispatch('getLangages');
            this.langagesList = this.$store.state.langages
        },
        //TODO Matt - A terminer, problème object array
        // async initializeReferentiel() {
        //     try {
        //         const req = await apiService.get('/api/notes/3')
        //         this.notes = req.data.data
        //         var langNote = 0
        //         var langI = 0
        //         await this.notes.forEach(note => {
        //             if (note.sondage_line_id.langage) {
        //                 this.langagesList.forEach(_langList => {
        //                     if (note.sondage_line_id.langage.name == _langList.name) {
        //                         langI++
        //                         langNote = langNote + note.note
        //                         this.langagesNoted[note.sondage_line_id.langage.name] = [{ note: Math.floor(langNote / langI), langage: note.sondage_line_id.langage.name }]
        //                         this.Langages.push({
        //                             name: note.sondage_line_id.langage.name,
        //                             note: Math.floor(langNote / langI)
        //                         })
        //                     }
        //                 })
        //             }
        //             else if (note.sondage_line_id.skill) {
        //             }
        //         });
        //     }
        //     catch (err) { console.log(err) }
        // },
    }
}