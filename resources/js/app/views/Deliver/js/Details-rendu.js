import axios from "axios";
import {apiService} from "../../../services/apiService";

export default{
    props: ["titreProjet"],
    data () {
        return {
            rendu: null,
            user: null,
            projet: null,
            sticky: false,
            dialog: false,
        }
    },
    components: {
    },
    mounted() {

    },
    watch: {
    },
    methods: {
        async initialize() {
            const renduId = this.$router.currentRoute.params.id;
            const response = await axios.get("/api/deliver/view/rendus/" + renduId).then((result) => {
                this.rendu = result.data.rendu
                this.user = result.data.user
                this.projet = result.data.projet
            });
            console.log(this.rendu)
            console.log(this.user)
            console.log(this.projet)
        },
    },
    created() {
        this.initialize();
    },
}
