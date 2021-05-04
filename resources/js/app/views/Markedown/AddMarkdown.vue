<template>
    <div>
        <v-container>
            <h2>Ajouter une fiche</h2>
            <v-row>
                <v-col>
                    <v-select
                        :items="status"
                        label="Status"
                    ></v-select>
                </v-col>
                <v-col>
                    <v-select
                        :items="categories"
                        label="Catégorie"
                    ></v-select>
                </v-col>
                <v-col>
                    <v-btn>Ajouter Catégorie</v-btn>
                </v-col>
            </v-row>

            <v-text-field
                label="Titre"
                placeholder="Entrez le titre de la fiche"
                v-model="name"
            ></v-text-field>
            <markdown-editor theme="primary" ref="md" v-model="text" toolbar="redo | undo | bold | italic | strikethrough | heading | link |  quote |
        fullscreen | preview" :extend="custom"></markdown-editor>

            <v-btn onclick="">Valider</v-btn>
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
import Axios from "axios";
export default {
    name: "AddMarkedDown",
    components: {
        MdEditor
    },
    data() {
        return {
            name: '',
            status: ['En brouillon', 'Public'],
            categories: [],
            text: '',
            custom: {
                'preview': {
                    cmd: 'preview',
                    ico: 'far fa-eye',
                    title: 'Preview'
                },
                'fullscreen': {
                    cmd: 'fullscreen',
                    ico: 'fas fa-expand',
                    title: 'FullScreen'
                },
                'italic': {
                    cmd: 'italic',
                    ico: 'fas fa-italic',
                    title: 'italic'
                },
                'bold': {
                    cmd: 'bold',
                    ico: 'fas fa-bold',
                    title: 'bold'
                },
                'strikethrough': {
                    cmd: 'strikethrough',
                    ico: 'fas fa-strikethrough',
                    title: 'strikethrough'
                },
                'undo': {
                    cmd: 'undo',
                    ico: 'fas fa-undo',
                    title: 'undo'
                },
                'redo': {
                    cmd: 'redo',
                    ico: 'fas fa-redo',
                    title: 'redo'
                },
                'quote': {
                    cmd: 'quote',
                    ico: 'fas fa-quote-right',
                    title: 'quote'
                }
            },
        };
    },
    methods: {
        async addMarkDown() {
            let dataSend = {
                name: this.name,
                text: this.text,
                status: this.status,
                categoryId: this.categoryId
            }

            Axios.post('/markedowns/markdown/create', dataSend);
        }
    }
};
</script>
