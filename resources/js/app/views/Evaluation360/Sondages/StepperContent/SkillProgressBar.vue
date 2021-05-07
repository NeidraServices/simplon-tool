<template>
  <v-progress-linear
    class="sondage-progress-bar"
    v-model="skillNote"
    color="#bce9f7"
    height="25"
    @change="updateNote"
  >
    <strong>{{ displayNote }}/ 10</strong></v-progress-linear
  >
</template>
<script src="./skillProgressBar"/>