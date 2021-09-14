import { apiService } from '../../../../services/apiService.js'
import { EventBus } from '../../../../eventBus.js'

export default {
    components: {
        
    },

    data() {
        return {
            valid: true,
            isLoaded: false,
            edited: false,
            skillList: [],
            referentielList: [],

            search: '',
            headers: [
                {
                    text: 'Nom',
                    align: 'start',
                    filterable: false,
                    value: 'description',
                },
                { text: 'Actions', value: 'actions' },
            ],

            skillName: '',
            selectSkillRef: '',
            skillRules: [v => !!v || "Compétence requis"],
            skillRefRules: [v => !!v || "Référentiel requis"],

            title: '',
            selectedItem: '',
            generalDialog: false,
            deleteDialog: false
        }
    },

    created() {

    },

    watch: {
        selectedItem: function(val){
            this.skillName = val.description
        }
    },

    created() {
        this.getSkills()
        this.getReferentiel()
    },

    methods: {
        async getReferentiel() {
            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/referentiel/list`)
                const reqData = req.data.data;
                if(reqData)  this.referentielList = reqData;
            } catch (error) {
                EventBus.$emit('snackbar', {
                    text: `Referentiel : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                }) 
            }
        },

        async getSkills() {
            try {
                this.isLoaded = false;
                const req = await apiService.get(`${location.origin}/api/evaluation360/skill/list`)
                const reqData = req.data.data;
                if(reqData)  this.skillList = reqData;
                this.isLoaded = true;
            } catch (error) {
                EventBus.$emit('snackbar', {
                    text: `Skill : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                }) 
            }
        },

        async handleSkill() {
            try {
                await this.$refs.form.validate();
                if (this.valid) {
                    let req;
                    if(this.edited) {
                        req = await apiService.put(`${location.origin}/api/evaluation360/skill/${this.selectedItem.id}/update`, {
                            description: this.skillName,
                            referentiel_id: this.selectSkillRef.id
                        })
                    } else {
                        req = await apiService.post(`${location.origin}/api/evaluation360/skill/create`, {
                            description: this.skillName,
                            referentiel_id: this.selectSkillRef.id
                        })
                    }

                    const reqData = req.data;

                    if(reqData.success) {
                        await this.closeGeneral();
                        await this.getSkills();
                        await EventBus.$emit('snackbar', {
                            text: reqData.message,
                            color: 'success',
                            timeout: 3000
                        })
                    } else {
                        await EventBus.$emit('snackbar', {
                            text: reqData.message,
                            color: 'red',
                            timeout: 3000
                        })
                    }
                }
            } catch (error) {
                EventBus.$emit('snackbar', {
                    text: `Skill actions : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                }) 
            }
        },

        async deleteSkills() {
            try {
                const req = await apiService.delete(`${location.origin}/api/evaluation360/skill/${this.selectedItem.id}/delete`)
                const reqData = req.data;
                if(reqData.success) {
                    await this.getSkills();
                    await this.closeDeleteDialog();
                    await EventBus.$emit('snackbar', {
                        text: reqData.message,
                        color: 'success',
                        timeout: 3000
                    }) 
                } else {
                    EventBus.$emit('snackbar', {
                        text: reqData.message,
                        color: 'red',
                        timeout: 3000
                    }) 
                }
            } catch (error) {
                EventBus.$emit('snackbar', {
                    text: `Skill delete : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                }) 
            }
        },

                
        openGeneral(item = null, edit = null) {
            if(edit) {
                this.title = 'Modification compétence'
                this.selectedItem = item;
                this.edited = true;
            } else {
                this.title = "Ajout d'une compétence"
                this.selectedItem = '';
                
            }
            this.generalDialog = true;
        },

        closeGeneral() {
            this.title = ""
            this.selectedItem = '';
            this.skillName = '';
            this.selectSkillRef = '';
            this.generalDialog = false;
            this.edited = false;
        },

        openDeleteDialog(item) {
            this.selectedItem = item;
            this.deleteDialog = true;
        },

        closeDeleteDialog() {
            this.selectedItem = "";
            this.deleteDialog = false;
        },
    }
}