import Axios from "axios"

import Sidebar from '../../../layouts/Sidebar.vue'

import projet_ModalUpdate from "../components/projet-modal_update.vue"
import projet_ModalDelete from "../components/delete-projet.vue"
import projet_ModalAdd from "../components/add-projet.vue"
import Router from '../../../router.js';
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
        projet_ModalUpdate, projet_ModalDelete, projet_ModalAdd, Sidebar
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
        this.user    = user
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
        }
    }
}