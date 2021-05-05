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

            nameRules: [
                v => !!v || "Nom de l'apprenant requis"
            ],
            surnameRules: [
                v => !!v || "Nom de l'apprenant requis"
            ],
            emailRules: [
                v => !!v || "Nom de l'apprenant requis"
            ],

            selectItem: null
        }
    },

    watch: {

    },

    created() {
        this.getData()
    },

    methods: {
        openEditModal(item) {
            this.selectItem = item;
            this.editDialog = true;
        },

        openDeleteDialog(item) {
            this.selectItem   = item;
            this.deleteDialog = true;
        },

        closeEditModal(){
            this.selectItem = null;
            this.editDialog = false;
            this.getData()
        },

        closeDeleteDialog(){
            this.selectItem   = null;
            this.deleteDialog = false;
        },

        openAddModal() {
            this.createdDialog = true;
        },

        closeAddModal() {
            this.createdDialog = false;
            this.name = '';
            this.surname = '';
            this.email = '';
        },

        async getData() {
            try {
                const req = await apiService.get(`${location.origin}/api/users/list`);
                const reqData = req.data.data;
                this.userList = reqData;
                this.isLoaded = true;
            } catch (error) {
                console.log(error)
            }
        },

        async createApprenantAccount() {
            try {
                await this.$refs.form.validate();
                if (this.valid) {
                    let dataSend = {
                        name: this.name,
                        surname: this.surname,
                        email: this.email
                    }
                    const req  = await apiService.post(`${location.origin}/api/apprenants/create`, dataSend)
                    const reqData = req.data;
                    if(reqData.success) {
                        await this.$refs.form.resetValidation();
                        await this.closeAddModal();
                        await this.getData();
                        await console.log(reqData.message)
                    } else {
                        console.log(reqData.message)
                    }
                }
            } catch (error) {
                console.log(error)
            }
        },


        async updateApprenantAccount() {
            try {
                await this.$refs.formUpdate.validate();
                if (this.valid) {
                    let dataSend = {
                        name: this.selectItem.name,
                        surname: this.selectItem.surname,
                        email: this.selectItem.email
                    }
                    const req  = await apiService.put(`${location.origin}/api/apprenants/${this.selectItem.id}/update`, dataSend)
                    const reqData = req.data;
                    if(reqData.success) {
                        await this.$refs.formUpdate.resetValidation();
                        await this.closeEditModal();
                        await this.getData();
                        await console.log(reqData.message)
                    } else {
                        console.log(reqData.message)
                    }
                }
            } catch (error) {
                console.log(error)
            }
        },

        async deleteApprenanAccount() {
            try {
                const req  = await apiService.delete(`${location.origin}/api/apprenants/${this.selectItem.id}/delete`)
                const reqData = req.data;
                if(reqData.success) {
                    await this.closeDeleteDialog();
                    await this.getData();
                    await console.log(reqData.message)
                } else {
                    console.log(reqData.message)
                }
            } catch (error) {
                console.log(error)
            }
        },
    }
}