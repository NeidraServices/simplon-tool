import projet_ModalUpdate from "../components/projet-modal_update.vue"


const projets = [
    {
        id: 1,
        titre: "G-a-o",
        image: "/public/images/dp/default.png",
        deadline: "21-05-2021",
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
        projet_ModalUpdate
    },

    data(){
        return {
            projets: [],
            user: []
        }
    },

    mounted(){
        this.projets = projets
        this.user    = user
    },

    method:{
        get_projets: function(){

        }
    }
}