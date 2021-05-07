<template>
  <div class="text-center ma-2">
    <v-snackbar :timeout="timeout" :value="snackbar" :color="color" shaped>
      {{ text }}
      <template v-slot:action="{ attrs }">
        <v-btn color="white" v-bind="attrs" @click="snackbar = false" icon>
          <v-icon> mdi-close </v-icon>
        </v-btn>
      </template>
    </v-snackbar>
  </div>
</template>
<script src="./snackbar.js"/>
<style>
.v-snack__wrapper {
  position: absolute !important;
  bottom: 0 !important;
}
</style>