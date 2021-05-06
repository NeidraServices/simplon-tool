<template>
    <div>
        <v-container>
            <FlashMessage :position="'top'"></FlashMessage>
            <h2 class="titre">{{ name }}</h2>
            <v-row>
                <v-col>
                    {{ title }}
                    <p>{{ description }}</p>
                    <p>{{ text }}</p>
                </v-col>
            </v-row>
            <v-btn outlined @click="">Editer</v-btn>
            <br><br>
            <v-divider></v-divider>
            <br>
            <h3 class="titre">Commentaires :</h3>


            <div v-if="commentaries.length == 0 ">Aucun commentaires.</div>
            <div v-for="item in commentaries" :key="item.id">
                <h3> Nom Utilisateur {{item.user_id}}   :</h3>
                <small>{{item.created_at}}</small>
                <p>{{item.description}}</p>
                <divider></divider>
            </div>
            <v-textarea v-model="commentary" label="Ajouter un commentaire"></v-textarea>
            <v-btn outlined @click="postCommentary">Ajouter</v-btn>
            <br><br>
        </v-container>

    </div>
</template>
<style>
.v-md-toolbar {
    display: inline-flex;
    width: 100%;
}
</style>
<script>
import Axios from "axios";

export default {
    name: "ShowReadMd",
    components: {

    },
    props: {
        id: {
            type: String
        }
    },
    data() {
        return {
            name: '',
            active: '',
            category: '',
            description: '',
            commentary: '',
            title: '',
            status: [{
                label: 'En brouillon',
                value: 0
            },
                {
                    label: 'Public',
                    value: 1
                }],
            categories: [],
            commentaries: [],
            text: '',
        };
    },

    methods: {
        async getData() {
            try {
                const req = await Axios.get(`${location.origin}/api/markedown/markdown/${this.id}`)
                const reqData = req.data
                console.log(reqData)
                this.name = reqData.title
                this.description = reqData.description
                this.text = reqData.text
                this.active = reqData.status

            } catch (error) {
                console.log(error)
            }
        },
        async getCommentary() {
            try {
                const req = await Axios.get(`${location.origin}/api/markedown/commentaires/${this.id}`)
                this.commentaries = req.data;
                console.log(req.data)
            }catch (error) {
                console.log(error)
            }
        },
        async postCommentary() {
            const data = {
                description: this.commentary,
                userId : 1 // a changer pour avoir l'id dynamiquement
            }

            await Axios.post(`${location.origin}/api/markedown/commentaire/ajouter/${this.id}`, data).then(({ data }) => {
                this.flashMessage.success({
                    message: data.message,
                });
                this.getCommentary();
            })
        }
    },
    created() {
        this.getData();
        this.getCommentary();

    },
};
</script>
<style>
.titre {
    width: 100%;
    text-align: center;
    margin-bottom: 30px;
}
</style>
