<template>
  <v-card elevation="5" class="pa-5">
    <v-card-title class="text-center font-weight-light"
      >Référentiel</v-card-title
    >
    <v-expansion-panels focusable class="mb-6">
      <v-expansion-panel>
        <v-expansion-panel-header expand>
          Concevoir et développer des composants d’interface utilisateur en
          intégrant les recommandations de sécurité
          <template v-slot:actions>
            <span>8/10</span>
            <v-icon> mdi-arrow-down </v-icon>
          </template>
        </v-expansion-panel-header>
        <v-expansion-panel-content class="pt-5">
          <span> Maquetter une application </span
          ><span class="competences-notes">5/10</span>
        </v-expansion-panel-content>
        <v-expansion-panel-content class="pt-5">
          <span> Maquetter une application </span
          ><span class="competences-notes">5/10</span>
        </v-expansion-panel-content>
        <v-expansion-panel-content class="pt-5">
          <span> Maquetter une application </span
          ><span class="competences-notes">5/10</span>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>
  </v-card>
</template>
<script src="./referentielCards.js"/>
<style>
.competences-notes {
  position: absolute;
  right: 45px;
  border-left: 1px solid black;
  padding-left: 20px;
}
</style>