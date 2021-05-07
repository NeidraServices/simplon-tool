<template>
  <v-container>
    <v-row class="d-flex">
      <v-col cols="12" class="text-center font-weight-light">
        Commentaire général sur Apprenant 1
      </v-col>
      <v-col cols="6 ma-auto">
        <v-textarea
          v-model="commentaire"
          solo
          outlined
          name="input-7-4"
          label="Réponse ..."
        ></v-textarea>
      </v-col>
    </v-row>
    <div class="stepper-actions">
      <v-btn color="primary" @click="send"> Valider </v-btn>

      <v-btn text @click="cancel()"> retour </v-btn>
    </div>
  </v-container>
</template>
<script src="./commentaires.js"/>