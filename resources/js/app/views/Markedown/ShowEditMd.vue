<template>
    <div>
        <v-container>
            <FlashMessage :position="'top'" ></FlashMessage>
            <h2 class="titre">{{title}}</h2>
            <v-row>
                <v-col>
                    <v-select
                        v-model="active"
                        :items="status"
                        item-text="label"
                        item-value="value"
                        label="Status"
                        v-on:change="setStatus"
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
                        v-on:blur="setCategory"
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
                v-on:blur="updateTitle"
            ></v-text-field>
            <v-textarea
                outlined
                label="Description"
                placeholder="Entrez une description"
                v-model="description"
                v-on:blur="updateDescription"
            ></v-textarea>
            <v-divider></v-divider><br><br>
            
            <markdown-editor theme="primary" ref="md" v-model="text" toolbar="redo | undo | bold | italic | strikethrough | heading | link |  quote |
        fullscreen | preview" :extend="custom"></markdown-editor><br>
            <v-btn outlined @click="editMD">Editer</v-btn>
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
    name: "ShowEditMd",
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
            dialog: false,
            categorie: null,
            category: '',
            search: null,
            loading: false,
            disabledButton: true,
            activeModalCategory: false,
            name: '',
            title:'',
            active: '',
            description: '',
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
      search: function (val) {
        if (val && val.length > 1) {
          this.disabledButton = false;
          this.loading = true
          axios.get('/api/markedown/categorie/search', { params: { query: val } })
          .then(({ data }) => {

              this.loading = false;
              
              /* console.log(this.categorie)
              if (val !==) {
                  this.disabledButton = true;
              } */
              
              data.data.forEach(categorie => {
                  this.categories.push(this.formattedCategorie(categorie))
              });
          });
        }else{
            this.disabledButton = true;
        }
      },
    },
    methods: {
        formattedCategorie: function (categorie) {
            
            return {

                id: categorie.id,
                name: categorie.name,

                composed: categorie.name
            }
        },
         async setCategory(){
            if(typeof this.category.id  != 'undefined'){
                //console.log(this.category.id)
                let dataSend={
                    category:this.category.id
                }
                try {
                    const req = await  Axios.post(`${location.origin}/api/markedown/markdown/category/${this.id}`, dataSend)
                    const reqData = req.data
                    console.log(req)
                    this.flashMessage.success({
                        message: reqData.message,
                    });
                } catch (error) {
                    console.log(error)
                }
            }
        },
        async setStatus(){
            let dataSend={
                active:this.active
            }
            try {
                const req = await Axios.post(`${location.origin}/api/markedown/markdown/active/${this.id}`, dataSend)
                const reqData = req.data
                console.log(reqData)
                this.flashMessage.success({
                    message: reqData.message,
                });
            } catch (error) {
                console.log(error)
            }
        },
        async editMD(){
            let dataSend={
                text:this.text
            }
            try {
                const req = await Axios.post(`${location.origin}/api/markedown/markdown/edit/${this.id}`, dataSend)
                const reqData = req.data
                
                this.flashMessage.success({
                    message: reqData.message,
                });
                console.log(reqData)
            } catch (error) {
                console.log(error)
            }
        },
        async updateTitle(){
            let dataSend={
                title:this.title
            }
            try {
                const req = await Axios.post(`${location.origin}/api/markedown/markdown/update/title/${this.id}`, dataSend)
                const reqData = req.data
                console.log(reqData)
                
                this.flashMessage.success({
                    message: reqData.message,
                });
            } catch (error) {
                console.log(error)
            }
        },
         async updateDescription(){
            let dataSend={
                description:this.description
            }
            try {
                const req = await Axios.post(`${location.origin}/api/markedown/markdown/update/description/${this.id}`, dataSend)
                const reqData = req.data
                console.log(reqData)
                
                this.flashMessage.success({
                    message: reqData.message,
                });
            } catch (error) {
                console.log(error)
            }
        },
        async addCategoryModal(){
            if (this.isValid()) {
                const data = {
                    name: this.name,
                };
                await axios.post('/api/markedown/categorie/ajouter', data)
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
        async getData() {
            
            try {
                const req = await Axios.get(`${location.origin}/api/markedown/markdown/${this.id}`)
                const reqData = req.data
                console.log(reqData)
                this.title= reqData.markdown.title
                let category ={
                    composed:reqData.markdown.category.name,
                    id:reqData.markdown.category.id
                }
                
                this.categories.push( category)
                this.category=this.categories[0]
                console.log(this.category)
                this.description = reqData.markdown.description
                this.text= reqData.text
                this.active= reqData.markdown.status
                
                
            } catch (error) {
                console.log(error)
            }
         }
    },
    computed: {
        
        
        validate() {
            return this.isValid()
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
