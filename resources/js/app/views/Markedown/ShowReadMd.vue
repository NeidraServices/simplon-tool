<template>
    <div>
        <v-container>
            <FlashMessage :position="'top'" ></FlashMessage>
            <h2 class="titre">{{name}}</h2>
            <v-row>
                <v-col>
                    {{title}}
                    <p>klj{{ text }}</p>
                </v-col>
            </v-row>
            <v-btn outlined @click="editMD">Editer</v-btn>
            <br><br>
            <v-divider></v-divider>
            <br>
            <v-textarea label="Commentaire"></v-textarea>
            <v-btn outlined @click="update">Ajouter</v-btn><br><br>
            <h3 class="titre">Commentaires :</h3>

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
import MdEditor from "./component/MdEditor";
import AutocompleteCategorie from "./component/AutocompleteCategorie";
import Axios from "axios";
export default {
    name: "ShowReadMd",
    components: {
        MdEditor,
        AutocompleteCategorie
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
            title: '',
            status: [{
                label:'En brouillon',
                value:0
            },
                {
                    label:'Public',
                    value:1
                }],
            categories: [],
            text: '',
        };
    },

    methods : {
        async getData() {

            try {
                const req = await Axios.get(`${location.origin}/api/markedown/markdown/${this.id}`)
                const reqData = req.data
                console.log(reqData)
                this.name= reqData.title
                this.text= reqData.text
                this.active= reqData.status


            } catch (error) {
                console.log(error)
            }
        }
    },
    created() {
        this.getData();
    },
};
</script>

<style>
.titre{
    width: 100%;
    text-align: center;
    margin-bottom: 30px;
}
</style>
