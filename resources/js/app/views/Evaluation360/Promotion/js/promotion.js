import { EventBus } from "../../../../eventBus.js";
import { apiService } from "../../../../services/apiService.js";

export default {
    components: {

    },

    mounted() {

    },

    data() {
        return {
            valid: true,
            isLoaded: false,
            promotions: [],

            title: '',
            promoName: '',
            edited: false,

            search: '',
            headers: [
                {
                    text: 'Nom de la promotion',
                    align: 'start',
                    filterable: true,
                    value: 'name',
                },

                { text: 'Actions', value: 'actions' },
            ],

            promoNameRules: [v => !!v || "Promotion requise requis"],
            selectItem: "",
            generalDialog: false,
            deleteDialog: false
        }
    },

    watch: {
        selectItem: function (val) {
            this.promoName = val.name;
        }
    },

    created() {
        this.getPromotions();
    },

    methods: {
        openGeneral(edit, item = null) {
            if (edit) {
                this.title = "Modification de la promotion"
                this.selectItem = item;
                this.edited = true;
            } else {
                this.title = "Ajout d'une promotion"
            }

            this.generalDialog = true;
        },
        closeGeneral() {
            this.generalDialog = false;
            this.edited = false;
            this.title = '';
            this.selectItem = '';
        },
        openDelete(item) {
            this.deleteDialog = true;
            this.selectItem = item;
        },
        closeDelete() {
            this.deleteDialog = false;
            this.selectItem = "";
        },
        async getPromotions() {
            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/promotion/list`)
                const reqData = req.data.data;
                this.promotions = reqData;
                this.isLoaded = true;
            } catch (error) {
                EventBus.$emit('snackbar', {
                    text: `Promotions : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                })
            }
        },

        async handlePromotion() {
            try {
                await this.$refs.form.validate();
                if (this.valid) {
                    let req;
                    if(this.edited) {
                        req = await apiService.put(`${location.origin}/api/evaluation360/promotion/${this.selectItem.id}/update`, {name: this.promoName})
                    } else {
                        req = await apiService.post(`${location.origin}/api/evaluation360/promotion/create`, {name: this.promoName})
                    }

                    const reqData = req.data;

                    if(reqData.success) {
                        this.isLoaded = false;
                        this.promoName = '';
    
                        await this.closeGeneral();
                        await this.getPromotions();
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
                    text: `Action promotion : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                })
            }
        },

        async deletePromotion() {
            try {
                const req = await apiService.delete(`${location.origin}/api/evaluation360/promotion/${this.selectItem.id}/delete`)
                const reqData = req.data;
                if(reqData.success) {
                    this.isLoaded = false;
                    this.promoName = '';

                    await this.closeDelete();
                    await this.getPromotions();
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
            } catch (error) {
                EventBus.$emit('snackbar', {
                    text: `Supp promotion : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                })
            }
        }
    }
}