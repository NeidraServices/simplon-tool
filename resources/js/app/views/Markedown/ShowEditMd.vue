<template>
    <div>
        <v-container>
            <FlashMessage :position="'top'" ></FlashMessage>
            <h2 class="titre">{{name}}</h2>
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
                    <AutocompleteCategorie/>
                </v-col>
                <v-col>
                    <v-btn outlined>Ajouter Catégorie</v-btn>
                </v-col>
            </v-row>

            <v-text-field
                label="Titre"
                placeholder="Entrez le titre de la fiche"
                v-model="name"
            ></v-text-field>
            <v-textarea
                outlined
                name="description"
                label="Description"
                :value="description"
            ></v-textarea>
            <v-btn outlined @click="updateTitle">Enregistrer</v-btn><br><br>
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
            name: '',
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
    methods: {
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
                title:this.name
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
                title:this.name
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
        async getData() {
            
            try {
                const req = await Axios.get(`${location.origin}/api/markedown/markdown/${this.id}`)
                const reqData = req.data
                console.log(reqData)
                this.name= reqData.title
                this.description = reqData.description
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
