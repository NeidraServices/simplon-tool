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


    methods: {
        delete_projet: function(){
            this.$emit('delete_projet', this.project_id)
        }
    }
}