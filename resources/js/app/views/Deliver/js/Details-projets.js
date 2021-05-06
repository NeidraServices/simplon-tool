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
        // this.getRenduData().then(r => {});
        this.getApprenantData().then(r => {});
    },
    methods: {
        async getProjetData() {
            // this.idProjet=location.href.substr(location.href.lastIndexOf("/")+1)
            try {
                const req = await apiService.get(`${location.origin}/api/deliver/projets/${this.id}/voir`);
                this.projet = req.data.projet;
                this.apprenants = req.data.apprenants;
                this.isLoaded = true;
            } catch (error) {
                console.log(error)
            }
        },
        // async getRenduData() {
        //     try {
        //         const req = await apiService.get(`${location.origin}/api/view/rendus/projects/${this.id}`);
        //         this.isLoaded = true;
        //     } catch (error) {
        //         console.log(error)
        //     }
        // },
        async getApprenantData() {
            let allApprenants = this.allApprenants;
            const req = await apiService.get(`${location.origin}/api/apprenants`);
            for (let i = 0; i < req.data.data.length; i++) {
                allApprenants.push(req.data.data[i]);
            }
            this.allApprenants = allApprenants;
        },
        submit(item) {
            console.log(item);

            let dataToSend = {
                user_id : item[0].id,
                projet_id : this.id,
            }

            console.log(dataToSend);

            const dataPost = apiService.post(`${location.origin}/api/deliver/projet/affecter`, dataToSend);

            const verifyDataPost = dataPost.data;
            console.log(verifyDataPost)
            this.dialog = false
        },
    }
}
