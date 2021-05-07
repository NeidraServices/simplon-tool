import Axios from "axios"

import projet_ModalDelete from "../components/delete-projet.vue"
import Modal_projet from "../components/projet_modal.vue"

import Router from '../../../router.js';

export default{
    components:{
        projet_ModalDelete, Modal_projet
    },
    data(){
        return {
            projets: [],
            user: [],
            id:0
        }
    },

    mounted(){
        this.get_projets()
        this.user    = this.$store.state.userInfo
    },

    methods:{
        get_projets: function(){
            console.log("get projet");
            Axios.get("/api/deliver/projets")
            .then(({data}) => {
                console.log(data);
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