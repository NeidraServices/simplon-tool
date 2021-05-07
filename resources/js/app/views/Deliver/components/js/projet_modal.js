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
            color_btn: "",

            titre: "",
            deadline:     new Date().toISOString().substr(0, 10),
            presentation: new Date().toISOString().substr(0, 10),
            description: "",
            extrait: "",

            technos: [],
            techno_items: [],

            tags: [],
            tags_items: []
        }
    },

    mounted(){
        this.get_referentiel()
        this.get_techno()
        if(this.projet !== null){
            this.set_referentiel()
            this.titre    = this.projet.titre
            this.extrait  = this.projet.extrait
            this.deadline = this.projet.deadline
            this.presentation = this.projet.presentation
            this.technos = this.projet.techno
            this.tags = this.projet.competences
            this.card_title = "Modifier le projet " + this.projet.titre
            this.url        = "/api/deliver/projets/" + this.projet.id + "/modifier"
            this.button     = ' mdi-pencil-circle  '
            this.color_btn  = "orange"
        }else{
            this.card_title = "Ajouter un projet"
            this.url        = "/api/deliver/projets/ajouter"
            this.button     = '   mdi-plus '
            this.color_btn  = "success"
            this.description = "Pas encore de description !"
        }
    },


    methods: {
        create_update: function(){
            axios.post(this.url, {
                titre:this.titre,
                description:this.description,
                deadline:this.deadline,
                presentation:this.presentation,
                competences:this.tags,
                technos: this.technos,
                formateur_id: this.$store.state.userInfo.id,
                extrait: this.extrait
            }).then(({data}) => {
                console.log(data);
                if(!data.success){
                    this.flashMessage.error({
                        message: data.error
                    });
                }else{
                    this.$emit('append_projet', data.projet_created)
                    this.dialog = false
                }
            })
        },

        get_referentiel: function(){
            axios.get("/api/deliver/competences")
            .then(({data}) => {
                data.forEach(element => {
                    this.tags_items.push(element.nom)
                });
            })
        },

        get_techno: function(){
            axios.get("/api/deliver/tags")
            .then(({data}) => {
                data.forEach(element => {
                    this.techno_items.push(element.nom)
                });
            })
        },

        set_referentiel: function(){
            console.log(this.projet);
        },

        set_description: function(description){
            this.description = description
        }
    }

}