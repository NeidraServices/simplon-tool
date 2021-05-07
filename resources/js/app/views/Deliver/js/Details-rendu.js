import axios from "axios";
import {apiService} from "../../../services/apiService";

export default{
    props: ["titreProjet"],
    data () {
        return {
            rendu: null,
            mediasEditor: null,
            user: null,
            projet: null,
            githubUrl: null,
            siteUrl: null,
            v0: true,
            dialog: false,
            transparent: 'rgba(255, 255, 255, 0)',
            icons: ['mdi-delete'],

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
                this.mediasEditor = result.data.rendu.medias
                this.user = result.data.user
                this.projet = result.data.projet
                this.githubUrl = result.data.rendu.github_url
                this.siteUrl = result.data.rendu.site_url
            });


            console.log(this.rendu)
            console.log(this.user)
            console.log(this.projet)
        },

        editRendu() {
            const response = axios.get("/api/deliver/edit/rendus/" + this.rendu.id)

            // const response = await axios.get("/producer/update", {
            //     params: {
            //         description: this.producerDescription
            //     }
            // })
        },
        test(medias) {
            console.log(medias)
        },
    },
    created() {
        this.initialize();
    },
}
