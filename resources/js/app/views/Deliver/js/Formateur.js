import {apiService} from "../../../services/apiService";

export default{
    data () {
        return {
            isLoaded: false,
            dialog: false,
            dialogRendu: false,
            tab: null,
            idProjet:0,
            currentUser: [],
            menus: [
                {title: 'tags'},
                {title: 'competences'},
            ],
            ajout:false,
            tags:[],
            competences:[],
            nomTag:null,
            tag:[],
            id:0
        }
    } ,   
    created() {
        this.getTags();
        
    },
    methods: {
        async getTags() {
           
            try {
                const req = await apiService.get(`${location.origin}/api/deliver/tags`);
                
               
                this.tags=req.data;
            } catch (error) {
                console.log(error)
            }
        },
        editTag(item){
            this.tag=item;
            this.nomTag=item.nom;
        },
      async  updateTag(){
            try {

                const req = await apiService.post(`${location.origin}/api/deliver/tags/update`,{id:this.tag.id,nom:this.nomTag});
                if(req.data.success){
                    this.dialog=false;
                    this.getTags();
                }
            } catch (error) {
                console.log(error)
            }
        },
        async addTag(){
            try {

                const req = await apiService.post(`${location.origin}/api/deliver/tags/ajout`,{nom:this.nomTag});
                if(req.data.success){
                    this.ajout=false;
                    this.getTags();
                }
            } catch (error) {
                console.log(error)
            }
        },
       async supprimerTag(id){
            try {

                const req = await apiService.post(`${location.origin}/api/deliver/tags/delete`,{id:id});
                if(req.data.success){
                
                    this.getTags();
                }
            } catch (error) {
                console.log(error)
            }

        }
    }

}