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
    components: {
    },
    mounted() {
    },
    watch: {
    },
    created() {
        // console.log(this.$store);
        // console.log(this.$store.state);
        // this.currentUser = this.$store.state.userInfo;

        this.getProjetData().then(r => {});
        this.getRenduData().then(r => {});
        this.getApprenantData().then(r => {});
    },
    methods: {
        async getProjetData() {
            try {
                const req = await apiService.get(`${location.origin}/api/deliver/projets/${this.id}/voir`);
                this.projet = req.data.projet[0];

                let allApprenants = [];

                for(let i = 0; i < req.data.projet[0].users.length; i++) {
                    allApprenants.push(req.data.projet[0].users[i])
                }

                this.apprenants = allApprenants;
                this.isLoaded = true;
            } catch (error) {
                console.log(error)
            }
        },
        async getRenduData() {
            // this.idProjet=location.href.substr(location.href.lastIndexOf("/")+1)
            try {
                const req = await apiService.get(`${location.origin}/api/deliver/view/rendus/projects/${this.id}`);
                let allRendu = [];
                for (let i = 0; i < req.data[0].length; i++) {
                    if (parseInt(req.data[0][i].projet.id) === parseInt(this.id, 10)) {
                        allRendu.push(req.data[0][i])
                    }
                }
                this.rendu = allRendu;
                this.isLoaded = true;
            } catch (error) {
                console.log(error)
            }
        },
        async getApprenantData() {
            let allApprenants = this.allApprenants;
            const req = await apiService.get(`${location.origin}/api/apprenants`);
            for (let i = 0; i < req.data.data.length; i++) {
                allApprenants.push(req.data.data[i]);
            }
            this.allApprenants = allApprenants;
        },
        submit(item) {
            let dataToSend = {};
            let users = [];

            for (let i = 0; i < item.length; i++) {
                users.push(item[i].id);
            }

            dataToSend = {
                users : users,
                projet_id : parseInt(this.id),
            }

            console.log(dataToSend);

            const dataPost = apiService.post(`${location.origin}/api/deliver/projet/affecter`, dataToSend);


            console.log(dataPost)

            this.dialog = false
        },
    }
}
