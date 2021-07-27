<template>
    <div>
        <v-container>
            <h2 class="titre">{{ name }}</h2>
            <v-row>
                <v-col>
                    {{ title }}
                    <h2>Description</h2>
                    <p>{{ description }}</p>

                    <Editor
                        mode="viewer"
                        ref="editor"
                        hint="Test"
                        :outline="false"
                        :preview="true"
                        v-model="text"
                    />
                </v-col>
            </v-row>
            <v-btn outlined @click="sendRequest">Faire une demande de modification.</v-btn>
            <br/><br/>
            <v-divider></v-divider>
            <br/>
            <h3 class="titre">Commentaires :</h3>

            <div v-if="commentaries.length == 0">Aucun commentaires.</div>
            <div v-for="item in commentaries" :key="item.id">
                <v-img :src="getAvatar(item.user.avatar)"></v-img>
                <h3>{{ item.user.name }} {{ item.user.surname }} :</h3>
                <small>{{ item.createdAt | formatDate }}</small>
                <p>{{ item.description }}</p>
                <v-divider></v-divider>
            </div>
            <v-textarea
                v-model="commentary"
                label="Ajouter un commentaire"
            ></v-textarea>
            <v-btn outlined @click="postCommentary">Ajouter</v-btn>
            <br/><br/>
        </v-container>
    </div>
</template>

<style>
.v-md-toolbar {
    display: inline-flex;
    width: 100%;
}

.titre {
    width: 100%;
    text-align: center;
    margin-bottom: 30px;
}
</style>

<script>
import {Editor} from "vuetify-markdown-editor";
import {apiService} from "../../../services/apiService";
import {EventBus} from "../../../eventBus";

export default {
    name: "ShowReadMd",
    components: {
        Editor,
    },
    props: {
        id: {
            type: String,
        },
    },
    data() {
        return {
            name: "",
            active: "",
            category: "",
            description: "",
            commentary: "",
            title: "",
            status: [
                {
                    label: "En brouillon",
                    value: 0,
                },
                {
                    label: "Public",
                    value: 1,
                },
            ],
            categories: [],
            commentaries: [],
            text: "",
        };
    },
    methods: {
        async getData() {
            try {
                const req = await apiService.get(`${location.origin}/api/markedown/markdown/${this.id}`);
                const reqDataMd = req.data.markdown;

                this.name = reqDataMd.title;
                this.description = reqDataMd.description;
                this.text = req.data.text;
                this.active = reqDataMd.status;
                this.commentaries = reqDataMd.commentary

                console.log(req.data)

            } catch (error) {
                console.log(error);
            }
        },
        postCommentary() {
            const data = {
                description: this.commentary,
                userId: this.$store.state.userInfo.userId,
            };
            apiService.post(`${location.origin}/api/markedown/commentaire/ajouter/${this.id}`, data).then(({data}) => {
                EventBus.$emit('snackbar', {
                    snackbar: true,
                    text: data.message,
                    color: 'blue',
                    timeout: 3000
                })
                this.getData();
            });
        },
        async sendRequest() {
            try {
                let contribution = await apiService.get(`${location.origin}/api/markedown/contribution/${this.id}`)
                if (contribution) {
                    EventBus.$emit('snackbar', {
                        snackbar: true,
                        text: contribution.data.message,
                        color: 'blue',
                        timeout: 3000
                    })
                }
            } catch (e) {
                EventBus.$emit('snackbar', {
                    snackbar: true,
                    text: e,
                    color: 'blue',
                    timeout: 3000
                })
            }
        },
        getAvatar(image) {
            return `${location.origin}/images/${image}`;
        },
    },
    mounted() {
        this.getData();
    },
};
</script>

