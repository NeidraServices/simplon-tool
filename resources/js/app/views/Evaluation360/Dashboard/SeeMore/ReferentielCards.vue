<template>
  <v-card elevation="5" style="flex: 1">
    <v-card-title class="font-weight-thin"
      ><span class="ma-auto">Référentiel</span></v-card-title
    >
    <v-expansion-panels focusable class="mb-6 pa-5">
      <v-expansion-panel>
        <v-expansion-panel-header expand>
          Concevoir et développer des composants d’interface utilisateur en
          intégrant les recommandations de sécurité
          <template v-slot:actions>
            <span>8/10</span>
            <v-icon> mdi-arrow-down </v-icon>
          </template>
        </v-expansion-panel-header>
        <v-expansion-panel-content class="pt-5 pb-5">
          <v-row>
            <v-col cols="8"
              ><span class="competences-title">
                Maquetter une application
              </span>
            </v-col>
            <v-col class="text-right text-xs-center" cols="4">
              <span class="competences-notes">5/10</span>
            </v-col>
          </v-row>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>
  </v-card>
</template>
<script src="./referentielCards.js"/>
<style>
</style>