<template>
  <div>
    <v-list nav dense>
      <v-list-item
        v-for="(menu, key) in menuList"
        :key="key"
        link
        :to="menu.route"
        color='#d14631'
      >
        <v-list-item-title> {{ menu.title }}</v-list-item-title>
      </v-list-item>
    </v-list>
  </div>
</template>

<script src="./menuEval.js" />