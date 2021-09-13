<template>
  <div>
    <v-list nav dense v-if="userRole == 1 || userRole == 2">
      <v-list-item
        v-for="(menu, key) in trainerMenu"
        :key="key"
        link
        :to="menu.route"
      >
        <v-list-item-title> {{ menu.title }}</v-list-item-title>
      </v-list-item>
    </v-list>

    <v-list nav dense v-if="userRole == 3">
      <v-list-item
        v-for="(menu, key) in learnerMenu"
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