import { method } from "lodash"

const projets = [
    {
        id: 1,
        titre: "G-a-o",
        image: "/public/images/dp/default.png",
        deadline: "21-05-2021",
        description: "Projet gao qui consiste ...."
    }
]
export default{
    data(){
        return {
            projets: [],

        }
    },

    mounted(){
        this.projets = projets
    },

    method:{
        get_projets: function(){

        }
    }
}