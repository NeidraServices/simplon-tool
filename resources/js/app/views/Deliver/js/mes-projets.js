import Axios from "axios"

import Sidebar from '../../../layouts/Sidebar.vue'
import Router from '../../../router.js';

import {apiService} from "../../../services/apiService";

export default{
    components:{
        Sidebar, apiService
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
        console.log();
    },

    methods:{
        get_projets: function(){
            apiService.get("/api/deliver/projets/mesprojets/" + this.$store.state.userInfo.id)
            .then(({data}) => {
                this.projets = data.response
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
        }
    }
}