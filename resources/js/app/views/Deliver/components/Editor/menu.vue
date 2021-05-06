<template>
  <div>
    <template v-for="(item, index) in items">
      <div class="divider" v-if="item.type === 'divider'" :key="index" />
      <menu-item v-else :key="index" v-bind="item" />
    </template>
  </div>
</template>

<script src="./js/menu.js"></script>

<style lang="scss" scoped>
.divider {
  width: 2px;
  height: 1.25rem;
  background-color: rgba($colorBlack, 0.1);
  margin-left: 0.5rem;
  margin-right: 0.75rem;
}
</style>