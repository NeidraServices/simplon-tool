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

            editBtn: false,

            rendu: null,

        }
    },
    

    methods: {
        initialize() {
            const renduId = this.$router.currentRoute.params.id;
            apiService.get("/api/deliver/view/rendus/" + renduId)
            .then(({data}) => {
                console.log("data: ", data);
                this.projet = data.rendu.projet 
                this.user   = data.rendu.user
                this.rendu  = data.rendu
            });

            console.log('user: ', this.user);
            console.log('projet: ' + this.projet);
        },

        editRendu() {
            this.editBtn = false;
            let formData = new FormData();
            formData.append("user_id", this.user.id);
            formData.append("github_url", this.githubUrl);
            formData.append("site_url", this.siteUrl);

            if(this.images != null) {
                for (const file of this.images) {
                    formData.append('medias[]', file)
                }
            }

            apiService.post("/api/deliver/edit/rendus/" + this.rendu.id, formData).then((response) => {
                console.log(response)
            }).catch((er) => {
                console.log(er)
            })
            this.initialize();
        },

        selectImage(val) {
            this.images = val.target.files;
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
