<template>
  <div class="editor" v-if="editor">
      <Menu :editor="editor"/>
      <editor-content :editor="editor" height="500px"  />
  </div>
</template>

<script src="./js/editor.js"></script>
<style lang="scss">
/* Basic editor styles */
.ProseMirror {
  height: 100px;
  border: solid 1px black;
  padding: 5px;
  > * + * {
    margin-top: 0.75em;
    
  }
}
</style>