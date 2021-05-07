import { Editor, EditorContent } from '@tiptap/vue-2'
import { defaultExtensions } from '@tiptap/starter-kit'
import Menu from "../menu.vue"

export default {
  props: {
    description: {
      required: true
    }
  },


  components: {
    EditorContent, Menu
  },

  data() {
    return {
      editor: new Editor({
        extensions: defaultExtensions(),
        content: (this.description !== null) ? this.description : `<h3> Pas encore de description pour le moment, entrez en une ! </h3>`,
        onBlur: ({ event, state, view }) => {
          this.$emit('set_description', this.editor.contentComponent.$el.innerHTML)
        }
      }),
    }
  },

  mounted() {
    console.log(this.description);
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
