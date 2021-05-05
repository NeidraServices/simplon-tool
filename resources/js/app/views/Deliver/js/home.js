import Axios from "axios"

import Sidebar from '../../../layouts/Sidebar.vue'

import projet_ModalUpdate from "../components/projet-modal_update.vue"
import projet_ModalDelete from "../components/delete-projet.vue"


const projets = [
    {
        id: 1,
        titre: "G-a-o",
        image: "/public/images/dp/default.png",
        deadline: "2021-05-01",
        description: "Projet gao qui consiste ....",
        formateur: {
            name: "Adrien",
        }
    }
]
const user  = {
    id: 1,
    name: "lcs", 
    surname: "lvn",
    avatar: "",
    email: "lucas.lvn97439@gmail.com",
    role:["admin", "formateur"]

}

export default{
    components:{
        projet_ModalUpdate, projet_ModalDelete, Sidebar
    },

    data(){
        return {
            projets: [],
            user: []
        }
    },

    mounted(){
        this.get_projets()
        this.user    = user
    },

    methods:{
        get_projets: function(){
            Axios.get("/api/deliver/projets")
            .then(({data}) => {
                this.projets = data.projets
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