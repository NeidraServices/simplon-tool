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
        this.getData().then(
            r => {
                console.log("r");
                console.log(r);
            }
        )
    },
    methods: {
        async getData() {
            try {
                const req = await apiService.get(`${location.origin}/api/deliver/projets/1/voir`);

                console.log("req.data.data");
                console.log(req.data.data);

                this.projet = req.data.data;
                console.log(this.projet);
                this.isLoaded = true;
            } catch (error) {
                console.log(error)
            }
        }
    }
}
