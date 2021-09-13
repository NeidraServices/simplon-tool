<template>
  <v-container fluid>
    <h2 class="text-center">Statistiques</h2>
    <v-divider class="px-10 my-5"></v-divider>

    <pie-chart
      v-if="isLoaded"
      :chartdata="chartDataSondage"
      :options="chartOptionsSondage"
    ></pie-chart>
  </v-container>
</template>

<script src="./home.js"></script>