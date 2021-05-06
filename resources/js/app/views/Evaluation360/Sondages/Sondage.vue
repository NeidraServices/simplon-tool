<template>
  <v-container style="height: 100%">
    <v-stepper style="height: 100%" v-model="e1">
      <v-stepper-header>
        <v-stepper-step :complete="e1 > 1" step="1"> Questions </v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step :complete="e1 > 2" step="2">
          Langues & Référentiel
        </v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step step="3"> Commentaire</v-stepper-step>
      </v-stepper-header>

      <v-stepper-items style="height: 100%">
        <v-stepper-content step="1">
          <Questions />

          <div class="stepper-actions">
            <v-btn color="primary" @click="e1 = 2"> Continuer </v-btn>
          </div>
        </v-stepper-content>

        <v-stepper-content step="2">
          <Languages />
          <div class="stepper-actions">
            <v-btn color="primary" @click="e1 = 3"> Continuer </v-btn>

            <v-btn text @click="e1 = 1"> retour </v-btn>
          </div>
        </v-stepper-content>

        <v-stepper-content step="3">
          <Commentaires />
          <div class="stepper-actions">
            <v-btn color="primary" @click="e1 = 1"> Continuer </v-btn>

            <v-btn text @click="e1 = 2"> retour </v-btn>
          </div>
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
  </v-container>
</template>
<script src='./sondage.js'/>
<style>
.sondage-langages-notes {
  width: 60px;
  height: 60px;
  float: right;
  margin-top: -15px;
  border-radius: 200px !important;
  text-align: center;
  margin-right: -35px;
  z-index: 1;
}
.sondage-progress-bar {
  box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14),
    0 1px 5px 0 rgba(0, 0, 0, 0.12);
  border-radius: 10px;
}
.v-progress-linear__background {
  background-color: white !important;
}
.stepper-actions {
  position: absolute;
  bottom: 10vh;
}
</style>