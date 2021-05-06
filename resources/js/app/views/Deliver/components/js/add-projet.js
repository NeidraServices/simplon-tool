import axios from "axios"
import Editor from "../Editor/editor.vue"
import { EventBus } from '../../../../eventBus.js';

export default{
    components:{
        Editor
    },

    props: {
        user: {
            required: true
        }
    },

    data(){
        return {
            dialog: false,
            menu: false,
            menu_: false,

            titre: "",
            deadline: new Date().toISOString().substr(0, 10),
            presentation: new Date().toISOString().substr(0, 10),
            description: "szs",
            image: [],

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
            axios.post("/api/deliver/projets/ajouter", {
                titre:this.titre,
                description: this.description,
                deadline:this.deadline,
                image:this.image,
                presentation:this.presentation,
                competences:this.tags,
                techno:this.techno,
                formateur_id:2
            }).then(({data}) => {
                console.log(data);
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
            this.description = {description: description}
        }
    }
}