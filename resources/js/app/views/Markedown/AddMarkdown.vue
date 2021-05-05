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
                    <AutocompleteCategorie />
                </v-col>
                
                <v-col>
                <v-dialog
                v-model="dialog"
                persistent
                max-width="600px"
                >
                    <template v-slot:activator="{ on }">
                        <v-btn v-on="on">
                            Ajouter une catégorie
                        </v-btn>
                        
                    </template>

                    <v-card>
                        <v-card-title> Ajouter une catégorie </v-card-title>

                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" md="6">
                                        <v-text-field v-model="name" color="success" label="Nom de la catégorie : " required />
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn outlined color="red" text @click="dialog = false">Annuler</v-btn>
                            <v-btn outlined color="success" @click="addCategoryModal" :disabled="!validate" class="mr-2">Ajouter</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-col>
            </v-row>

            <v-text-field
                label="Titre"
                placeholder="Entrez le titre de la fiche"
                v-model="title"
            >
            </v-text-field>
            <v-textarea
                outlined
                name="description"
                label="Description"
                :value="description"
            ></v-textarea>
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
import AutocompleteCategorie from "./component/AutocompleteCategorie";
import {APIService} from './Services/ServiceRecupCateg';
export default {
    name: "AddMarkedDown",
    components: {
        MdEditor,
        AutocompleteCategorie
    },
    data() {
        return {
            title: '',
            name: '',
            title: '',
            description: '',
            status: ['En brouillon', 'Public'],
            dialog: false,
            categorie: {},
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
        init: function () {
            this.name = ''
            this.categorie = {}
        },      
        addCategoryModal(){
            if (this.isValid()) {
                const data = {
                    name: this.name,
                };
                axios.post('/api/markedown/categorie/ajouter', data)
                    .then(({ data }) => {
                        this.$emit('create', data.data)
                        this.dialog = false
                    })
                    .catch(error => {
                        //TODO catch error
                        console.log(error);
                    });
            }
        },

        isValid() {
            return this.name != ''
        },

        async addMarkDown() {
            let dataSend = {
                name: this.name,
                text: this.text,
                description: this.description,
                status: this.status,
                categoryId: this.categoryId
            }

            axios.post('/markedowns/markdown/create', dataSend);
        }
    },

    computed: {
        validate() {
            return this.isValid()
        }
    }
};
</script>
