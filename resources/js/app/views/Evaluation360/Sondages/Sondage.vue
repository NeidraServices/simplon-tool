<template>
  <v-container style="height: 100%" v-if="sondage">
    <div class="font-weight-thin text-center mb-5">
      <h1 class="font-weight-thin text-center">{{ sondage.name }}:</h1>
      <span>{{ sondage.user.name }} {{ sondage.user.surname }}</span>
    </div>

    <v-stepper
      class="mb-5"
      style="height: 100%"
      v-model="e1"
      v-if="sondage != {}"
    >
      <v-stepper-header>
        <v-stepper-step :complete="e1 > 1" step="1" color=' #d14631'> Questions </v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step :complete="e1 > 2" step="2" color=' #d14631'> Langues </v-stepper-step>

        <v-divider></v-divider>
        <v-stepper-step :complete="e1 > 3" step="3" color=' #d14631'>
          Compétences
        </v-stepper-step>

        <v-divider></v-divider>
        <v-stepper-step step="4"> Commentaire</v-stepper-step>
      </v-stepper-header>

      <v-stepper-items style="height: 100%">
        <v-stepper-content step="1">
          <Questions :questions="questions" />
        </v-stepper-content>

        <v-stepper-content step="2">
          <Languages :Languages="languages" />
        </v-stepper-content>

        <v-stepper-content step="3">
          <Skills :skills="skills" />
        </v-stepper-content>
        <v-stepper-content step="4">
          <Commentaires />
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