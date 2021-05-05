import Axios from "axios"

import MainLayout from '../../../layouts/Sidebar.vue'

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
        projet_ModalUpdate, projet_ModalDelete, MainLayout
    },

    data(){
        return {
            projets: [],
            user: []
        }
    },

    mounted(){
        this.projets = projets
        this.get_projets()
        this.user    = user
    },

    methods:{
        get_projets: function(){
            Axios.get("/api/deliver/projets")
            .then((data) => {
                console.log(data);
            })
        }
    }
}