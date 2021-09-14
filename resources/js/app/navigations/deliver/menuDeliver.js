

export default{

    data(){
        return{
            isApprenant:true,
        }
    },
    mounted(){
this.checkRole()
console.log("est  apprenant : "+this.isApprenant)
    },

methods:{


    checkRole:function(){
        let role=JSON.parse( localStorage.getItem("role") )

        if(role.name==="apprenant"){
            this.isApprenant=true
        }else{
            this.isApprenant=false
        }
    }
}
}