import {apiService} from "../../../services/apiService";

export default{
    data () {
        return {
            isLoaded: false,
            tab: null,
            menus: [
                {title: 'Détail'},
                {title: 'Liste des rendus'},
            ],
            projet: [],
        }
    },
    components: {
    },
    mounted() {
    },
    watch: {
    },
    created() {
        this.getData().then(r => console.log(r))
    },
    methods: {
        async getData() {
            try {
                const req = await apiService.get(`${location.origin}/api/deliver/projet`);
                const reqData = req.data.data;
                console.log(reqData);
                this.projet = reqData;
                console.log(this.projet);
                this.isLoaded = true;
            } catch (error) {
                console.log(error)
            }
        }
    }
}
