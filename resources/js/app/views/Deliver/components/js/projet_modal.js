import { apiService, ApiServices } from '../../../../services/apiService.js'
import axios from "axios"
import Editor from "../Editor/editor.vue"

export default{
    components:{
        Editor
    },

    props: {
        projet: {
            required: true
        }
    },

    data(){
        return {
            dialog: false,
            menu: false,
            menu_: false,

            card_title: "",
            url: "",
            button: "",
            button_text: "",
            button_color: "",

            titre: "",
            deadline:     new Date().toISOString().substr(0, 10),
            presentation: new Date().toISOString().substr(0, 10),
            description: "",
            extrait: "",

            technos: [],
            techno_items: [],

            competences: [],
            competence_items: []
        }
    },

    mounted(){
        this.get_referentiel()
        this.get_techno()
    
        if(this.projet !== null){
            this.set_technos()
            this.set_competence()
            this.titre    = this.projet.titre
            this.extrait  = this.projet.extrait
            this.deadline = this.projet.deadline
            this.presentation = this.projet.date_presentation
            this.url        = "/api/deliver/projets/" + this.projet.id + "/modifier"
            this.description = this.projet.description

            this.button     = 'mdi-pencil-circle'
            this.button_text = "Modifier"
            this.button_color = "orange"
            this.card_title = "Modifier le projet " + this.projet.titre
        }else{

            this.card_title = "Ajouter un projet"
            this.url        = "/api/deliver/projets/ajouter"
            this.button     = '   mdi-plus '
            this.description = "Pas encore de description !"

            this.button_text = "Ajouter"
            this.button_color = "success"
        }
    },


    methods: {
        create_update: function(){
            axios.post(this.url, {
                titre:      this.titre,
                description:this.description,
                deadline:   this.deadline,

                date_presentation: this.presentation,
                competences:  this.competences,
                technos:      this.technos,
                formateur_id: this.$store.state.userInfo.id,
                extrait:      this.extrait
            }).then(({data}) => {
                if(!data.success){
                    this.flashMessage.error({
                        message: data.error
                    });
                }else{
                    if(this.projet){
                        this.projet.date_presentation = this.presentation
                        this.projet.description = this.description
                        this.projet.competences = this.competences
                        this.projet.titre       = this.titre
                        this.projet.deadline = this.deadline
                        this.projet.tags     = this.technos
                        this.projet.extrait  = this.extrait
                        
                    }else{
                        this.$emit('append_projet', data.projet_created)
                    }
                    
                }
                this.dialog = false
                this.$emit('refresh_projets')
            })
        },

        get_referentiel: function(){
            apiService.get("/api/evaluation360/referentiel/list")
            .then(({data}) => {
                data.data.forEach(element => {
                    this.competence_items.push(element.description)
                });
            })
        },

        get_techno: function(){
            apiService.get("/api/deliver/tags")
            .then(({data}) => {
                data.forEach(element => {
                    this.techno_items.push(element.nom)
                });
            })
        },

        set_technos: function(){
            this.projet.tags.forEach(element => {
                this.technos.push(element.nom)
            })
        },

        set_competence: function(){
            this.projet.competences.forEach(element => {
                this.competences.push(element)
            })
        },

        set_description: function(description){
            this.description = description
        }
    }

}