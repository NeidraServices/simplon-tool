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
            edited: false,
            title: '',
            search: '',
            userList: [],
            headers: [
                {
                    text: 'Nom',
                    align: 'start',
                    filterable: false,
                    value: 'name',
                },
                { text: 'Prénoms', value: 'surname' },
                { text: 'Email', value: 'email' },
                { text: 'Etat', value: 'verify' },
                { text: 'Actions', value: 'actions' },
            ],

            createdDialog: false,
            editDialog: false,
            deleteDialog: false,
            name: '',
            surname: '',
            email: '',
            promoList: [],
            selectedPromo: '',

            nameRules: [
                v => !!v || "Nom de l'apprenant requis"
            ],
            surnameRules: [
                v => !!v || "Prenom de l'apprenant requis"
            ],
            emailRules: [
                v => !!v || "Email de l'apprenant requis",
                v => /.+@.+\..+/.test(v) || "Ce champ doit être un email"
            ],
            promotionRules: [
                v => !!v || "Promotion requise"
            ],
            selectItem: null,
            generalDialog: false
        }
    },

    watch: {

    },

    created() {
        this.getData()
    },

    methods: {
        openGeneral(item = null, isEdited = false) {
            this.edited = isEdited;
            this.generalDialog = true;
            if (isEdited) {
                this.title = "Modifier un compte apprenant"
                this.selectItem = item;
                this.name = item.name;
                this.surname = item.surname;
                this.email = item.email;
            } else {
                this.title = "Ajouter un compte apprenant"
            }
        },

        closeGeneral() {
            this.edited = false;
            this.generalDialog = false;
            this.name = '';
            this.surname = '';
            this.email = '';
        },

        openDeleteDialog(item) {
            this.selectItem = item;
            this.deleteDialog = true;
        },

        closeDeleteDialog() {
            this.selectItem = null;
            this.deleteDialog = false;
        },

        async getData() {
            try {
                const req      = await apiService.get(`${location.origin}/api/evaluation360/apprenants`);
                const reqPromo = await apiService.get(`${location.origin}/api/evaluation360/promotion/list`);
                const reqData = req.data.data;
                const reqDataPromo = reqPromo.data.data;
                this.promoList = reqDataPromo;
                this.userList = reqData;
                this.isLoaded = true;
            } catch (error) {
                console.log(error)
            }
        },

        async deleteApprenanAccount() {
            try {
                const req = await apiService.delete(`${location.origin}/api/evaluation360/apprenants/${this.selectItem.id}/delete`)
                const reqData = req.data;
                if (reqData.success) {
                    await this.closeDeleteDialog();
                    await this.getData();
                    await EventBus.$emit('snackbar', { text: reqData.message, color: 'error' })
                } else {
                    console.log(reqData.message)
                }
            } catch (error) {
                console.log(error)
            }
        },

        async accountAction() {
            try {
                var req;

                let dataSend = {
                    name: this.name,
                    surname: this.surname,
                    email: this.email,
                    promotion: this.selectedPromo.id
                }

                if (this.edited) {
                    req = await apiService.put(`${location.origin}/api/evaluation360/apprenants/${this.selectItem.id}/update`, dataSend)
                } else {
                    req = await apiService.post(`${location.origin}/api/evaluation360/apprenants/create`, dataSend)
                }

                const reqData = req.data;
                if (reqData.success) {
                    await this.$refs.form.resetValidation();
                    await this.closeGeneral();
                    await this.getData();
                    await EventBus.$emit('snackbar', { text: reqData.message, color: 'success' })
                } else {
                    console.log(reqData.message)
                }
            } catch (error) {
                console.log(error)
            }
        }
    }
}