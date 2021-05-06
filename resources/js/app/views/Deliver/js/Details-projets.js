import {apiService} from "../../../services/apiService";

export default{
    data () {
        return {
            isLoaded: false,
            dialog: false,
            dialogRendu: false,
            tab: null,
            currentUser: [],
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
    },
    methods: {
        async getData() {
            try {
                const req = await apiService.get(`${location.origin}/api/deliver/projets/1/voir`);
                this.projet = req.data.projet;
                this.apprenants = req.data.apprenants;
                this.isLoaded = true;
            } catch (error) {
                console.log(error)
            }
        }
    }
}
