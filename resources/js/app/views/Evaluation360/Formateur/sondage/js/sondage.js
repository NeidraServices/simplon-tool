import { apiService } from "../../../../../services/apiService.js";

export default {
    components: {

    },

    mounted() {

    },

    data() {
        return {
            valid: true,
            isLoaded: false,
            disabled: true,

            selectLangages: [],
            selectSkills: [],
            sondagesList: [],
            sondageLines: [],
            sondageName: '',
            published: '',

            etatList: [
                {
                    label: 'Brouillon',
                    id: '0'
                },
                {
                    label: 'Publié',
                    id: '1'
                }
            ],

            sondageNameRules: [
                v => !!v || "Le nom est requis"
            ],
            publishedRules: [
                v => !!v || "L'état est requis"
            ],

            search: '',
            headers: [
                {
                    text: 'Nom du sondage',
                    align: 'start',
                    filterable: true,
                    value: 'name',
                },

                { text: 'Actions', value: 'actions' },
            ],

            selectItem: null,
            createdDialog: false
        }
    },

    watch: {
        sondageLines: function (val) {
            if (val.length == 0) {
                this.disabled = true;
            } else {
                this.disabled = false;
            }
        }
    },

    created() {
        this.getLangages()
        this.getSkills()
        this.getSondages();
    },

    methods: {
        openAddModal() {
            this.createdDialog = true
        },
        closeAddModal() {
            this.sondageLines = []
            this.createdDialog = false
        },
        async getSondages() {
            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/formateur/sondage/list`)
                const reqData = req.data.data;
                this.sondagesList = reqData;
                this.isLoaded = true;
            } catch (error) {
                console.log(error)
            }
        },
        async getLangages() {
            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/langage/list`)
                const reqData = req.data.data;
                this.selectLangages = reqData;
                this.selectLangages.unshift({
                    id: "",
                    name: "Aucun"
                })
            } catch (error) {
                console.log(error)
            }
        },
        async getSkills() {
            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/skill/list`)
                const reqData = req.data.data;
                this.selectSkills = reqData;
            } catch (error) {
                console.log(error)
            }
        },
        async createSondage() {
            try {
                if (this.sondageLines.length == 0) {
                    console.log('Il faut des lignes dans votre sondage')
                } else {
                    let dataSend = {
                        name: this.sondageName,
                        lines: this.sondageLines,
                        published: this.published
                    }
                    const req = await apiService.post(`${location.origin}/api/evaluation360/formateur/sondage/create`, dataSend);
                    const reqData = req.data;
                    if (reqData.success) {
                        await this.getSondages()
                        await this.closeAddModal()
                    } else {
                        console.log(reqData.message)
                    }
                }
            } catch (error) {
                console.log(error)
            }
        },
        addLines() {
            this.sondageLines.push({
                langage_id: '',
                skill_id: ''
            })
        }
    }
}