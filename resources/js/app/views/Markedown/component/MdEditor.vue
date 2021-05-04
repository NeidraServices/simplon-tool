<template>
    <div>

        <v-container>
            <h2>Ajouter une fiche</h2>
            <v-spacer></v-spacer>
            <v-select>{{ status }}</v-select>
            <markdown-editor theme="primary" ref="md" v-model="text" toolbar="redo | undo | bold | italic | strikethrough | heading | image | link |  quote |
        fullscreen | preview" :extend="custom"></markdown-editor>
        </v-container>

    </div>
</template>
<script>
export default {
    name: "MdEditor",
    components: {

    },
    data() {
        return {
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
                    cmd : 'strikethrough',
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
                'quote' : {
                    cmd: 'quote',
                    ico: 'fas fa-quote-right',
                    title: 'quote'
                }
            },
            status: ['En brouillon', 'Public'],
            options: {
                 lineNumbers: true,
                // styleActiveLine: true,
                // styleSelectedText: true,
                // lineWrapping: true,
                // indentWithTabs: true,
                // tabSize: 2,
                // indentUnit: 2
            }
        };
    },
    methods:{
        upload(md){
            md.drawImage({url:'https://i.imgur.com/CbCXhBe.png', title:'this image title'});
        }
    }
};
</script>
