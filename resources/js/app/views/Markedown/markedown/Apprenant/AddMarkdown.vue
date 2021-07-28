<template>
    <div>
        <v-container>
            <h2>Ajouter une fiche</h2>
            <v-row>
                <v-col>
                    <v-select
                        item-text="label"
                        item-value="value"
                        :items="status"
                        v-model="active"
                        label="Status"
                    ></v-select>
                </v-col>
                <v-col>
                    <v-autocomplete
                        v-model="category"
                        :loading="loading"
                        :items="categories"
                        :search-input.sync="search"
                        item-text="composed"
                        item-value="id"
                        append-icon=''
                        return-object
                        cache-items
                        flat
                        hide-no-data
                        hide-details
                        label="Catégorie">
                    </v-autocomplete>
                </v-col>

                <v-col class="mt-4" cols="2">
                <v-dialog
                v-model="dialog"
                persistent
                max-width="600px"
                >
                    <template v-slot:activator="{ on }">
                        <!-- <v-btn v-on="on">
                            Ajouter une catégorie
                        </v-btn> -->
                        <v-btn icon color="green" v-if="disabledButton" disabled>
                            <v-icon> mdi-plus-circle-outline</v-icon>
                        </v-btn>

                        <v-btn v-on="on" icon color="green" v-else @click="addCategoryModal">
                            <v-icon> mdi-plus-circle-outline</v-icon>
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
            ></v-text-field>
            <v-textarea
                outlined
                name="description"
                label="Description"
                v-model="description"
            ></v-textarea>
            <markdown-editor
            theme="primary"
            ref="md"
            v-model="text"
            toolbar="redo | undo | bold | italic | strikethrough | heading | link |  quote | fullscreen | preview"
            :extend="custom"></markdown-editor>

            <v-btn @click="addMarkDown">Valider</v-btn>
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
import MdEditor from "../../component/MdEditor";
import AutocompleteCategorie from "../../component/AutocompleteCategory";
import {APIService} from '../../Services/Services';
import {apiService} from "../../../../services/apiService";
import {EventBus} from "../../../../eventBus";
const apiCall = new APIService()

export default {
    name: "AddMarkedDown",
    components: {
        MdEditor,
        AutocompleteCategorie,
    },
    data() {
        return {
            title: '',
            category: '',
            name: '',
            text: '',
            description: '',
            disabledButton: true,
            activeModalCategory: false,
            active: '',
            status:[
                {
                    label:'En brouillon',
                    value: 0
                },
                {
                    label:'Publié',
                    value: 1
                }
            ],

            dialog: false,
            categorie: null,
            categories: [],
            search: null,
            loading: false,

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

    watch: {
      search: async function (val) {
        if (val && val.length > 1) {
          this.disabledButton = false;
          this.loading = true
            let datas = await apiService.get(`${location.origin}/api/markedown/categorie/search` ,{ query: val })
            datas.data.data.forEach(category => {
                  this.categories.push(this.formattedCategorie(category))
            });
        }else{
            this.disabledButton = true;
        }
      },
    },
    computed: {
        validate() {
            return this.isValid()
        }
    },
    methods: {
        init: function () {
            this.name = ''
            this.categorie = {}
        },
        async addMarkDown() {
            const data = {
                title: this.title,
                text: this.text,
                description: this.description,
                active: this.active,
                category: this.category.id,
                user : this.$store.state.userInfo.id
            };

           apiService.post(`${location.origin}/api/markedown/markdown/create`, data).then(response =>{
                    const reqData = response.data
                        EventBus.$emit('snackbar', {
                            snackbar: true,
                            text: `Markedown crée avec succès !`,
                            color: 'blue',
                            timeout: 3000
                        })
                    }).catch (error => {
                   console.log(error)
                   EventBus.$emit('snackbar', {
                       snackbar: true,
                       text: `Markedown crée avec succès !`,
                       color: 'blue',
                       timeout: 3000
                   })
            })
        },

        addCategoryModal(){
            if (this.isValid()) {
                const data = {
                    name: this.name,
                };
                apiService.post(`${location.origin}/api/markedown/categorie/ajouter`, data).then(({ data }) => {
                        EventBus.$emit('snackbar', {
                            snackbar: true,
                            text: data.data.message,
                            color: 'blue',
                            timeout: 3000
                        })
                        this.$emit('create', data.data)
                        this.dialog = false
                    }).catch(error => {
                        EventBus.$emit('snackbar', {
                            snackbar: true,
                            text: "Une erreur est survenue",
                            color: 'red',
                            timeout: 3000
                        })
                    });
            }
        },
        formattedCategorie: function (categorie) {
            return {
                id: categorie.id,
                name: categorie.name,
                composed: categorie.name
            }
        },

        openCategoryModal(){
            this.isActiveModalCategory = true
            this.$emit('addCategoryModalActive', false);
        },

        isValid() {
            return this.name != ''
        }
    },
};
</script>
