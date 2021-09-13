<template>
  <v-container>
    <v-row class="d-flex">
      <v-col cols="12" class="text-center font-weight-light">
        Commentaire général
      </v-col>
      <v-col cols="12 ma-auto" lg="6">
        <v-textarea
          v-model="commentaire"
          solo
          outlined
          name="input-7-4"
          label="Réponse ..."
        ></v-textarea>
      </v-col>
    </v-row>
    <div class="stepper-actions mb-5">
      <v-btn color="primary" @click="send" to="/evaluation360/sondages">
        Valider
      </v-btn>

      <v-btn text @click="cancel()"> retour </v-btn>
    </div>
  </v-container>
</template>
<script src="./commentaires.js"/>