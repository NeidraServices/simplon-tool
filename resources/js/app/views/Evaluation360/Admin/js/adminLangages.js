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
            langageList: [],

            search: '',
            headers: [
                {
                    text: 'Nom',
                    align: 'start',
                    filterable: false,
                    value: 'name',
                },
                { text: 'Actions', value: 'actions' },
            ],

            langageName: '',
            langageImage: null,
            langageRules: [v => !!v || "Langage requis"],
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
            console.log(val)
        }
    },

    created() {
        this.getLangages();
    },

    methods: {
        async getLangages() {
            try {
                this.isLoaded = false;
                const req = await apiService.get(`${location.origin}/api/evaluation360/langage/list`)
                const reqData = req.data.data;
                if(reqData)  this.langageList = reqData;
                this.isLoaded = true;
            } catch (error) {
                EventBus.$emit('snackbar', {
                    text: `Langage : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                }) 
            }
        },

        
        async handleLangage() {
            try {
                await this.$refs.form.validate();
                if (this.valid) {
                    let req;
                    let formData = new FormData();
                    formData.append('name', this.langageName)
                    formData.append('image', this.langageImage)

                    if(this.edited) {
                        req = await apiService.post(`${location.origin}/api/evaluation360/langage/${this.selectedItem.id}/update`, formData)
                    } else {
                        req = await apiService.post(`${location.origin}/api/evaluation360/langage/create`, formData)
                    }

                    const reqData = req.data;

                    if(reqData.success) {
                        await this.closeGeneral();
                        await this.getLangages();
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
                    text: `Langage actions : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                }) 
            }
        },

        async deleteLangage() {
            try {
                const req = await apiService.delete(`${location.origin}/api/evaluation360/langage/${this.selectedItem.id}/delete`)
                const reqData = req.data;
                if(reqData.success) {
                    await this.getLangages();
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
                    text: `Langage delete : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                }) 
            }
        },
        
        openGeneral(item = null, edit = null) {
            if(edit) {
                this.title = 'Modification du langage'
                this.selectedItem = item;
                this.edited = true;
            } else {
                this.title = "Ajout d'un langage"
                this.selectedItem = '';
                
            }
            this.generalDialog = true;
        },

        closeGeneral() {
            this.title = ""
            this.selectedItem = '';
            this.langageName = "";
            this.langageImage = null;
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