import Axios from "axios"
import Editor from "../Editor/editor.vue"


export default{
    components:{
        Editor
    },

    props:{
        projet: {
            required: true
        }
    },

    mounted(){
        console.log(this.projet);
    },

    data(){
        return{
            date: new Date().toISOString().substr(0, 10),
            menu: false,
            dialog: false,

            titre: this.projet.titre,
            deadline: this.projet.deadline,
            presentation: this.projet.presentation,
            extrait: this.projet.extrait,
            description: this.projet.description,

        }
    },

    methods: {
        update_projet: function(){
            Axios.post('/api/deliver/projets/'+ this.projet.id+'/modifier', {
                titre: this.titre,
                deadline: this.deadline,
                description: this.description,
                image: (this.image) ? this.image : null
            }).then((data) => {
                
            })
        }
    }
}