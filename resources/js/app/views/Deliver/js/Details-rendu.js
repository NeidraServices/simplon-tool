import axios from "axios";
import {apiService} from "../../../services/apiService";

export default{
    props: ["titreProjet"],
    data () {
        return {
            rendu: null,
            sticky: false,
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
                this.rendu = result.data.data
            });
            console.log(this.rendu)
        },
    },
    created() {
        this.initialize();
    },
}
