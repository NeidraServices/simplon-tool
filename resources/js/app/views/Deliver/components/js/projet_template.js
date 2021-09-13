import projet_ModalDelete from "../delete-projet.vue"
import Modal_projet from "../projet_modal.vue"
import Router from '../../../../router.js';

export default{
    components:{
        projet_ModalDelete, Modal_projet    
    },

    props:{
        user: {
            required: true
        },
        projet: {
            required: true
        }
    },
    
    methods:{
        voir_projet(id){
            Router.push('/deliver/projet/'+id);
        },

        delete_projet: function(){
            this.$emit('delete_projet')
        },

        append_projet: function(){
            this.$emit('append_projet')
        }
    }
}