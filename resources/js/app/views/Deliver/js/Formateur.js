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
            ajoutTag:false,
            ajoutComp:false,
            tags:[],
            competences:[],
            nomComp:null,
            comp:[],
            nomTag:null,
            tag:[],
            id:0
        }
    } ,   
    created() {
          this.getTags();
        this.getComp();
      
    },
    methods: {
        async getTags() {
           
            try {
                const req = await apiService.get(`${location.origin}/api/deliver/tags`);
                
               
                this.tags=req.data;
                console.log(req.data);
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
                    this.tags.push(this.nomTag);
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

        },



        async getComp() {
           
            try {
                const req = await apiService.get(`${location.origin}/api/deliver/competences`);
                
               
                this.competences=req.data;
            } catch (error) {
                console.log(error)
            }
        },
        editComp(item){
            this.comp=item;
            this.nomComp=item.nom;
        },
      async  updateComp(){
            try {

                const req = await apiService.post(`${location.origin}/api/deliver/competences/update`,{id:this.comp.id,nom:this.nomComp});
                if(req.data.success){
                    this.dialog=false;
                    this.getComp();
                }
            } catch (error) {
                console.log(error)
            }
        },
        async addComp(){
            try {

                const req = await apiService.post(`${location.origin}/api/deliver/competences/ajout`,{nom:this.nomComp});
                if(req.data.success){
                    this.ajout=false;
                    this.getComp();
                }
            } catch (error) {
                console.log(error)
            }
        },
       async supprimerComp(id){
            try {

                const req = await apiService.post(`${location.origin}/api/deliver/competences/delete`,{id:id});
                if(req.data.success){
                
                    this.getComp();
                }
            } catch (error) {
                console.log(error)
            }

        }



    }

}