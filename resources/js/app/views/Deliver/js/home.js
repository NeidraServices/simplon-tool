import ProjetTemplate from '../components/projet_template.vue'
import Modal_projet from "../components/projet_modal.vue"
import Router from '../../../router.js';
import Axios from "axios"

export default{
    components:{
        ProjetTemplate, Modal_projet
    },
    data(){
        return {
            projets: [],
            user: this.$store.state.userInfo,
            id:0
        }
    },

    mounted(){
        this.get_projets()
    },

    methods:{
        get_projets: function(){
            Axios.get("/api/deliver/projets")
            .then(({data}) => {
                this.projets = data.projets
            })
        },
        
        voir_projet(id){
            Router.push('/deliver/projet/'+id);
        },

        delete_projet: function(project_id){
            Axios.post("/api/deliver/projets/"+ project_id +"/supprimer")
            .then(({data}) => {
                if(data.success == true){
                    this.projets = this.projets.filter(projet => projet.id != project_id)
                }
            })
        },

        append_projet: function(projet){
           this.projets.push(projet)
        },

    }
}