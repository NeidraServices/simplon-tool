import { Editor, EditorContent } from '@tiptap/vue-2'
import { defaultExtensions } from '@tiptap/starter-kit'
import Menu from "../menu.vue"

export default {
  components: {
    EditorContent, Menu
  },

  data() {
    return {
      editor: null,
    }
  },

  mounted() {
    this.editor = new Editor({
      extensions: defaultExtensions(),
      content: `
        <h2>
          Entrez-votre description pour le projet
        </h2>`,
        onBlur: ({ event, state, view }) => {
          this.$emit('set_description', this.editor.contentComponent.$el.innerHTML)
      }
    })
  },

  beforeDestroy() {
    this.editor.destroy()
  },

  methods:{
    get_content: function(){
      return this.editor.contentComponent.$el.innerHTML
    }
  }

}
