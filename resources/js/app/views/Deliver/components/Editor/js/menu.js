import { Editor, EditorContent } from '@tiptap/vue-2'
import { defaultExtensions } from '@tiptap/starter-kit'

export default {
    props: {
        editor:{
            required: true
        }
    },

    components: {
        EditorContent, 
    },

    data() {
        return {
        //   editor: null,
        }
    },

    mounted() {
        
    },

    beforeDestroy() {
        this.editor.destroy()
    },
}