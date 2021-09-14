import Axios from "axios"

import Sidebar from '../../../layouts/Sidebar.vue'
import Router from '../../../router.js';
export default{
    components:{
        Sidebar
    },
    data(){
        return {
            projets: [],
            futureprojets:[],
            user: [],
            id:0
        }
    },

    mounted(){
        this.get_projets()
    },

    methods:{
        get_projets: function(){
           let id =this.$store.state.userInfo.id
            Axios.post("/api/deliver/mesprojets",{userid:id})
            .then(({data}) => {
                this.projets = data.projets
                this.futureprojets=data.future_projets
              
            })
        },
        voir_projet(id){
            Router.push('/deliver/projet/'+id);
           // console.log(id);
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