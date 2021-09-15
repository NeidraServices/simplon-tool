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

            referentielName: '',
            referentielRules: [v => !!v || "Langage requis"],

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
            this.referentielName = val.description
        }
    },

    created() {
        this.getReferentiel();
    },

    methods: {
        async getReferentiel() {
            try {
                this.isLoaded = false;
                const req = await apiService.get(`${location.origin}/api/evaluation360/referentiel/list`)
                const reqData = req.data.data;
                if(reqData)  this.referentielList = reqData;
                this.isLoaded = true;
            } catch (error) {
                EventBus.$emit('snackbar', {
                    text: `Referentiel : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                }) 
            }
        },

        
        async handleReferentiel() {
            try {
                await this.$refs.form.validate();
                if (this.valid) {
                    let req;
                    if(this.edited) {
                        req = await apiService.put(`${location.origin}/api/evaluation360/referentiel/${this.selectedItem.id}/update`, {
                            description: this.referentielName
                        })
                    } else {
                        req = await apiService.post(`${location.origin}/api/evaluation360/referentiel/create`, {
                            description: this.referentielName
                        })
                    }

                    const reqData = req.data;

                    if(reqData.success) {
                        await this.closeGeneral();
                        await this.getReferentiel();
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
                    text: `Referentiel actions : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                }) 
            }
        },

        async deleteReferentiel() {
            try {
                const req = await apiService.delete(`${location.origin}/api/evaluation360/referentiel/${this.selectedItem.id}/delete`)
                const reqData = req.data;
                if(reqData.success) {
                    await this.getReferentiel();
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
                    text: `Referentiel delete : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                }) 
            }
        },
        
        openGeneral(item = null, edit = null) {
            if(edit) {
                this.title = "Modification d'un référentiel"
                this.selectedItem = item;
                this.edited = true;
            } else {
                this.title = "Ajout d'un référentiel"
                this.selectedItem = '';
                
            }
            this.generalDialog = true;
        },

        closeGeneral() {
            this.title = ""
            this.selectedItem = '';
            this.referentielName = '';
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