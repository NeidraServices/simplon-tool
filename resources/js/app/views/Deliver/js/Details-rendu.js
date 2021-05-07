import axios from "axios";
import {apiService} from "../../../services/apiService";

export default{
    props: ["titreProjet"],
    data () {
        return {
            rendu: null,
            medias: null,
            selectedMedias: null,
            images: null,
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
                this.medias = result.data.rendu.medias
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
            let formData = new FormData();
            formData.append("user_id", this.user.id);
            formData.append("github_url", this.githubUrl);
            formData.append("site_url", this.siteUrl);

            if(this.images != null) {
                for (const file of this.images) {
                    formData.append('medias[]', file)
                }
            }


            // formData.append("medias[]", this.selectedMedias);
            // console.log(this.selectedMedias)


            axios.post("/api/deliver/edit/rendus/" + this.rendu.id, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then((response) => {
                console.log(response)
            }).catch((er) => {
                console.log(er)
            })
        },
        selectImage(val) {
            this.images = val.target.files;
            console.log(this.images)
        },

        remove(media) {
            const index = this.medias.indexOf(media);
            if (index > -1) {
                this.medias.splice(index, 1);
            }
        },
        test(medias) {
            console.log(medias)
        },
    },
    created() {
        this.initialize();
    },
}
