<template>
<div>
    <div>
      <v-btn x-small icon  @click="editor.chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }">
        <v-icon>mdi-format-bold</v-icon>
      </v-btn>
      <v-btn x-small icon @click="editor.chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">
        <v-icon>mdi-format-italic</v-icon>
      </v-btn>
      <v-btn x-small icon @click="editor.chain().focus().toggleStrike().run()" :class="{ 'is-active': editor.isActive('strike') }">
        <v-icon>mdi-strikethrough</v-icon>
      </v-btn>
      <v-btn x-small icon @click="editor.chain().focus().toggleCode().run()" :class="{ 'is-active': editor.isActive('code') }">
        <v-icon>mdi-code</v-icon>
      </v-btn>
      <v-btn icon @click="editor.chain().focus().unsetAllMarks().run()">
        clear marks
      </v-btn>
      <v-btn icon @click="editor.chain().focus().clearNodes().run()">
        clear nodes
      </v-btn>
      <v-btn icon @click="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }">
        paragraph
      </v-btn>
      <v-btn icon @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }">
        h1
      </v-btn>
      <v-btn icon @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }">
        h2
      </v-btn>
      <v-btn icon @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }">
        h3
      </v-btn>
      <v-btn icon @click="editor.chain().focus().toggleHeading({ level: 4 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }">
        h4
      </v-btn>
      <v-btn icon @click="editor.chain().focus().toggleHeading({ level: 5 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }">
        h5
      </v-btn>
      <br>
      <v-btn icon @click="editor.chain().focus().toggleHeading({ level: 6 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 6 }) }">
        h6
      </v-btn>
      <v-btn icon @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }">
        bullet list
      </v-btn>
      <v-btn icon @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }">
        ordered list
      </v-btn>
      <v-btn icon @click="editor.chain().focus().toggleCodeBlock().run()" :class="{ 'is-active': editor.isActive('codeBlock') }">
        code block
      </v-btn>
      <v-btn icon @click="editor.chain().focus().toggleBlockquote().run()" :class="{ 'is-active': editor.isActive('blockquote') }">
        blockquote
      </v-btn>
      <v-btn icon @click="editor.chain().focus().setHorizontalRule().run()">
        horizontal rule
      </v-btn>
      <v-btn icon @click="editor.chain().focus().setHardBreak().run()">
        hard break
      </v-btn>
      <v-btn icon @click="editor.chain().focus().undo().run()">
        undo
      </v-btn>
      <v-btn icon @click="editor.chain().focus().redo().run()">
        redo
      </v-btn>
    </div>  
</div>

</template>

<script src="./js/menu.js"></script>
