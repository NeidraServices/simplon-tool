<template>
  <v-container class="d-flex justify-center align-center" style="height: 70% !important">
    <div>
      <div class="d-flex justify-start align-center mb-8">
        <h1 class="text-center">Liste des apprenants</h1>
        <v-btn icon class="py-5 ml-5">
          <v-icon color="green"> mdi-plus-circle-outline </v-icon>
        </v-btn>
      </div>

      <v-card width="900" class="mb-5">
        <v-card-title>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Rechercher"
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>
        <v-data-table
          :loading="!isLoaded"
          loading-text="Chargement en cours..."
          :headers="headers"
          :items="userList"
          :search="search"
          locale="fr"
        >
        </v-data-table>
      </v-card>
    </div>
  </v-container>
</template>

<script src="./js/cohorte.js"></script>