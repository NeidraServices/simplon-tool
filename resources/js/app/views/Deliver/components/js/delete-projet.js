import Axios from "axios"

export default{
    props:{
        project_id:{
            required: true
        }
    },
    data(){
        return {
            dialog: false
        }
    },


    method: {
        delete_projet: function(){
            Axios.post("/projets/"+ this.project_id +"/supprimer")
            .then((data) => {
                console.log(data);
            })
        }
    }
}