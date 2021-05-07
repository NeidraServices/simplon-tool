import axios from "axios"
import Editor from "../Editor/editor.vue"

export default{
    components:{
        Editor
    },

    props: {
        user: {
            required: true
        },
    },

    data(){
        return {
            dialog: false,
            menu: false,
            menu_: false,

            card_title: "",

            titre: "",
            deadline: new Date().toISOString().substr(0, 10),
            presentation: new Date().toISOString().substr(0, 10),
            description: "",
            extrait: "",

            techno: [],
            techno_items: [],

            tags: [],
            tags_items: []
        }
    },

    mounted(){
        this.get_referentiel()
        this.get_techno()
    },

    methods: {
        
        add_project: function(){
            axios.post("/api/deliver/projets/ajouter",
            {
                titre:this.titre,
                description:this.description,
                deadline:this.deadline,
                image:this.image,
                presentation:this.presentation,
                competences:this.tags,
                techno:this.techno,
                formateur_id: this.$store.state.userInfo.id,
                extrait: this.extrait
            }).then(({data}) => {
                if(!data.success){
                    this.flashMessage.error({
                        message: data.error
                    });
                }else{
                    console.log(data);
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

        set_description: function(description){
            this.description = description
        }
    }
}