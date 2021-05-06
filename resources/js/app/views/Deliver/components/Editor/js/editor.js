import { Editor, EditorContent } from '@tiptap/vue-2'
import { defaultExtensions } from '@tiptap/starter-kit'
import {EventBus } from '../../../../../eventBus.js';

import Menu from "../menu.vue"

export default {
  components: {
    EditorContent, Menu
  },

  data() {
    return {
      editor: new Editor({
        extensions: defaultExtensions(),
        content: `
          <h2>
            Entrez-votre description pour le projet
          </h2>`,
        onBlur: ({ event, state, view }) => {
            this.$emit('set_description', this.editor.contentComponent.$el.innerHTML)
        }
      }),
    }
  },

  mounted() {
   
  },

  beforeDestroy() {
    this.editor.destroy()
  },

}
