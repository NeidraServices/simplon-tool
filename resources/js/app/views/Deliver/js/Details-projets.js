import { createRelativePositionFromTypeIndex } from "yjs";
import Vue from 'vue';
import {apiService} from "../../../services/apiService";
import moment from "moment";

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY h:mm a')
    }
});

export default{
    data () {
        return {
            isLoaded: false,
            dialog: false,
            dialogRendu: false,
            dialogRep:false,
            tab: null,
            idProjet:0,
            currentUser: [],
            commentaires:[],
            commentaire:"",
            comId:0,
            reponseCom:"",
            menus: [
                {title: 'Détail'},
                {title: 'Liste des rendus'},
            ],
            projet: [],
            apprenants: [],
            select: { state: 'Florida'},
            items: [
                { user: 'Florida'},
                { user: 'Georgia'},
                { user: 'Nebraska'},
                { user: 'California'},
                { user: 'New York'},
            ],
        }
    },
    components: {
    },
    mounted() {
    },
    watch: {
    },
    created() {
        console.log(this.$store);
        console.log(this.$store.state);

        this.currentUser = this.$store.state.userInfo;
        console.log(this.currentUser);

        this.getData().then(
            r => {
                console.log(r);
            }
        )
        this.getComm();
    },
    methods: {
        async getData() {
            this.idProjet=location.href.substr(location.href.lastIndexOf("/")+1)
            try {
                const req = await apiService.get(`${location.origin}/api/deliver/projets/${this.idProjet}}/voir`);
                this.projet = req.data.projet;
                this.apprenants = req.data.apprenants;
                this.isLoaded = true;
            } catch (error) {
                console.log(error)
            }
        },
        async getComm(){
            this.idProjet=location.href.substr(location.href.lastIndexOf("/")+1)
            try {
                const req = await apiService.get(`${location.origin}/api/deliver/commentaires/${this.idProjet}}`);
                this.commentaires = req.data.commentaires;
            } catch (error) {
                console.log(error)
            }
        },
        async addCom(){
            this.idProjet=location.href.substr(location.href.lastIndexOf("/")+1)
            try {
               const req = await apiService.post(`${location.origin}/api/deliver/commentaires/ajouter`,{projet_id:this.idProjet,text:this.commentaire});
             
               if(req.data.success){
                this.dialogRep=false;
                this.commentaire="";
                this.getComm();
                }
             } catch (error) {
                console.log(error)
            }
        },
        setComid(id){
            this.comId=id;
        }
        ,
       async  repondreCom(){

            this.idProjet=location.href.substr(location.href.lastIndexOf("/")+1)
            try {
               const req = await apiService.post(`${location.origin}/api/deliver/commentaires/repondre`,{projet_id:this.idProjet,commentaire_id:this.comId,text:this.reponseCom});
             
               if(req.data.success){
                this.dialogRep=false;
                this.reponseCom="";
                this.getComm();
                }
             } catch (error) {
                console.log(error)
            }
        }
    }
}
