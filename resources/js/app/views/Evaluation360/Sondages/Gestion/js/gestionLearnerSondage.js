import { EventBus } from "../../../../../eventBus";
import { apiService } from "../../../../../services/apiService";

export default {
    components: {

    },

    props: {

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

            title: "Créer un sondage",
            edited: false,

            etatList: [
                {
                    label: 'Brouillon',
                    id: '0'
                },
                {
                    label: 'Publier',
                    id: '1'
                }
            ],


            sondageTypeList: [
                {
                    name: 'Langage',
                    id: '0'
                },
                {
                    name: 'Compétence',
                    id: '1'
                },
                {
                    name: 'Question',
                    id: '2'
                }
            ],

            sondageNameRules: [
                v => !!v || "Le nom est requis"
            ],

            publishedRules: [
                v => !!v || "L'état est requis"
            ],

            selectItem: null,
            generalDialog: false,
            deleteDialog: false,
            selectItem: null,

            search: '',
            headers: [
                { text: 'Créer le', value: 'created_at', filterable: true, align: 'start' },
                { text: 'Noms', value: 'name', filterable: true, },
                { text: 'Etats', value: 'published', filterable: true, },
                { text: 'Actions', value: 'actions', filterable: false, sortable: false }
            ],
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
        this.getSondages();
        this.getSkills();
        this.getLangages();
    },

    mounted() {

    },

    methods: {
        openGeneral(edit, item = null) {
            this.generalDialog = true
            this.edited = edit;
            if (this.edited) {
                this.title = "Mise à jour d'un sondage";
                this.selectItem = item;
                this.sondageName = item.name;

                if (item.published == "Publier") {
                    this.published = {
                        label: 'Publier',
                        id: '1'
                    };
                } else {
                    this.published = {
                        label: 'Brouillon',
                        id: '0'
                    };
                }

                var arrayContent = [];
                item.lines.forEach(element => {
                    if (element.langage != null) {
                        arrayContent.push({
                            type: {
                                name: 'Langage',
                                id: '0'
                            },
                            content: element.langage
                        })
                    } else if (element.skill != null) {
                        arrayContent.push({
                            type: {
                                name: 'Compétence',
                                id: '1'
                            },
                            content: element.skill
                        })
                    } else if (element.question != null) {
                        arrayContent.push({
                            type: {
                                name: 'Question',
                                id: '2'
                            },
                            content: element.question
                        })
                    }
                });

                this.sondageLines = arrayContent;

            } else {
                this.title = "Créer un sondage";
            }
        },

        closeGeneral() {
            this.sondageLines = [];
            this.generalDialog = false;
            this.title = "Créer un sondage";
            this.edited = false;
            this.sondageName = '';
            this.published = '';
            this.selectItem = null;
        },

        openDelete(item) {
            this.selectItem = item;
            this.deleteDialog = true;
        },

        closeDelete() {
            this.selectItem = null;
            this.deleteDialog = false;
        },

        addLines() {
            this.sondageLines.push({
                type: '',
                content: ''
            })
        },

        removeLine(key) {
            const filteredArray = this.sondageLines.filter(function (value, index, arr) {
                return index != key
            })
            this.sondageLines = filteredArray;
        },

        async getSondages() {
            try {
                const request = await apiService.get(`${location.origin}/api/evaluation360/apprenant/sondage/list`);
                const reqData = request.data.data;
                if (reqData) {
                    this.sondagesList = reqData;
                    this.isLoaded = true;
                }
            } catch (error) {
                EventBus.$emit('snackbar', {
                    text: `Sondages : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                })
            }
        },

        async getLangages() {
            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/langage/list`)
                const reqData = req.data.data;
                this.selectLangages = reqData;
            } catch (error) {
                EventBus.$emit('snackbar', {
                    text: `Langages : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                })
            }
        },

        async getSkills() {
            try {
                const req = await apiService.get(`${location.origin}/api/evaluation360/skill/list`)
                const reqData = req.data.data;
                this.selectSkills = reqData;
            } catch (error) {
                EventBus.$emit('snackbar', {
                    text: `Compétences : Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                })
            }
        },

        async handleSondage() {
            try {
                if (this.sondageLines.length == 0) {
                    console.log('Il faut des lignes dans votre sondage')
                } else {
                    let dataSend = {}
                    let req;

                    if (this.edited) {
                        let ligneFormated = [];

                        this.selectItem.lines.forEach(item => {
                            if (item.type.id) {
                                switch (item.type.id) {
                                    case 0:
                                        ligneFormated.push({
                                            type: item.type.id,
                                            content: item.content.id
                                        })
                                        break;
                                    case 1:
                                        ligneFormated.push({
                                            type: item.type.id,
                                            content: item.content.id
                                        })
                                        break;
                                    case 2:
                                        ligneFormated.push({
                                            type: item.type.id,
                                            content: item.content
                                        })
                                        break;
                                    default:
                                        break;
                                }
                            } else {
                                switch (item.type) {
                                    case 0:
                                        ligneFormated.push({
                                            type: item.type,
                                            content: item.langage.id
                                        })
                                        break;
                                    case 1:
                                        ligneFormated.push({
                                            type: item.type,
                                            content: item.skill.id
                                        })
                                        break;
                                    case 2:
                                        ligneFormated.push({
                                            type: item.type,
                                            content: item.question == null ? "" : item.question
                                        })
                                        break;
                                    default:
                                        break;
                                }
                            }
                        });
                        dataSend = {
                            name: this.sondageName,
                            lines: ligneFormated,
                            published: this.published
                        }

                        req = await apiService.put(`${location.origin}/api/evaluation360/sondage/update`, dataSend);
                    } else {

                        dataSend = {
                            name: this.sondageName,
                            lines: this.sondageLines,
                            published: this.published
                        }
                        req = await apiService.post(`${location.origin}/api/evaluation360/sondage/create`, dataSend);
                    }
                    const reqData = req.data;
                    if (reqData.success) {
                        await this.getSondages()
                        await this.closeGeneral()
                    } else {
                        EventBus.$emit('snackbar', {
                            snackbar: true,
                            text: reqData.message,
                            color: 'blue',
                            timeout: 3000
                        })
                    }
                }
            } catch (error) {
                EventBus.$emit('snackbar', {
                    text: `Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                })
            }
        },

        async deleteSondage() {
            try {
                const req = await apiService.delete(`${location.origin}/api/evaluation360/sondage/${this.selectItem.name}/delete`,);
                const reqData = req.data;
                if (reqData.success) {
                    await this.getSondages()
                    await this.closeDelete()
                } else {
                    EventBus.$emit('snackbar', {
                        snackbar: true,
                        text: reqData.message,
                        color: 'blue',
                        timeout: 3000
                    })
                }
            } catch (error) {
                EventBus.$emit('snackbar', {
                    text: `Une erreur est survenue`,
                    color: 'red',
                    timeout: 3000
                })
            }
        },

        editeChange(item, type) {
            if ((typeof item.content) == "object" && type == 2) {
                item.content = "";
            }
        },

        showDetailLangage(type) {
            if (this.edited) {
                if (type.id == 0) {
                    return true
                }
            } else {
                if (type == 0) {
                    return true
                }
            }
        },

        showDetailSkill(type) {
            if (this.edited) {
                if (type.id == 1) {
                    return true
                }
            } else {
                if (type == 1) {
                    return true
                }
            }
        },

        showDetailQuestion(type, content = null) {
            if (this.edited) {
                if (type.id == 2) {
                    return true
                }
            } else {
                if (type == 2) {
                    return true
                }
            }
        },
    }
}