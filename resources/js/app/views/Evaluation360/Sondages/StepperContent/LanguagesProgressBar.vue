<template>
  <v-row>
    <v-col cols="4">
      <v-card class="sondage-langages-notes d-flex">
        <img
          style="width: 100%; object-fit: contain"
          :src="getImages(language.image)"
        />
      </v-card>
    </v-col>
    <v-col cols="8">
      <v-progress-linear
        class="sondage-progress-bar"
        v-model="note"
        color="#bce9f7"
        height="25"
        @change="updateNote"
      >
        <strong>{{ displayNote }}/ 10</strong></v-progress-linear
      >
    </v-col>
  </v-row>
</template>
<script src="./languagesProgressBar.js"/>