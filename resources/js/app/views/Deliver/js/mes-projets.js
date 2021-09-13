import ProjetTemplate from '../components/projet_template.vue'
import {apiService} from "../../../services/apiService";
import Sidebar from '../../../layouts/Sidebar.vue'
import Axios from "axios"

export default{
    components:{
        Sidebar, apiService, ProjetTemplate
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
            apiService.get("/api/deliver/projets/mesprojets/" + this.$store.state.userInfo.id)
            .then(({data}) => {
                this.projets = data.response
            })
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