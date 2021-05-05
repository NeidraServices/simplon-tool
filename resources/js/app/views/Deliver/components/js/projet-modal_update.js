import Axios from "axios"


export default{
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
            image:  [],
            deadline: this.projet.deadline,
            description: this.projet.description
        }
    },

    methods: {
        update_projet: function(){
            Axios.post('/projets/'+ this.projet.id+'/modifier', {
                titre: this.titre,
                deadline: this.deadline,
                description: this.description,
                image: (this.image) ? this.image : null
            }).then((data) => {
                
            })
        }
    }
}