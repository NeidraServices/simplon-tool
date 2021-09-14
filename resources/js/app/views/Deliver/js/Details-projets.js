import {apiService} from "../../../services/apiService";

export default{
    name: 'showProjectDeliver',
    props: {
        id: {
            type: String
        }
    },
    data () {
        return {
            isLoaded: false,
            dialog: false,
            dialogRendu: false,
            tab: null,
            // idProjet:0,
            valid: true,
            newEmailApprenant: '',
            newApprenant: '',
            currentUser: [],
            menus: [
                {title: 'Détail'},
                {title: 'Liste des rendus'},
            ],
            projet: [],
            apprenants: [],
            allApprenants: [],
            rendu: []
        }
    },

    created() {

        this.currentUser = this.$store.state.userInfo;
        this.getProjetData().then(r => {});
        this.getRenduData().then(r => {});
        this.getApprenantData().then(r => {});
    },

    methods: {
        async getProjetData() {
            try {
                apiService.get(`/api/deliver/projets/${this.id}/voir`)
                .then(({data}) => {
                    console.log(data);
                    this.projet = data.projet[0]
                    this.apprenants = data.projet[0].users
                })

                this.isLoaded = true;
            } catch (error) {
                console.log(error)
            }
        },
        async getRenduData() {
            apiService.get(`/api/deliver/view/rendus/projects/${this.id}`)
            .then(({data}) => {
                console.log('data');
                console.log(data[0]);
                this.rendu = data[0]
            })
        },

        async getApprenantData() {
            let allApprenants = this.allApprenants;
            const req = await apiService.get(`${location.origin}/api/deliver/apprenants`);
            for (let i = 0; i < req.data.data.length; i++) {
                allApprenants.push(req.data.data[i]);
            }
            this.allApprenants = allApprenants;
        },
        
        async setRendu(){
            let dataToSend = {};

            dataToSend = {
                site_url:this.rendu["site_url"],
                github_url:this.rendu["github_url"],
                user_id:this.currentUser.id,
                medias:this.rendu["medias"],
                technos:this.rendu["technos"]
            }
            const req = await apiService.post(`${location.origin}/api/deliver/create/rendus/projects/${this.id}`,dataToSend);
           await this.getRenduData();
            this.dialogRendu = false
        },

        async submit(item) {
            let dataToSend = {};
            let users = [];

            for(let i = 0; i < item.length; i++) {
                users.push(item[i].id);
            }

            dataToSend = { users : users, projet_id : parseInt(this.id) }
            apiService.post('/api/deliver/projet/affecter', dataToSend)
            .then(({data}) => {
                console.log(data);
            })

            this.dialog = false
        },
    }
}
