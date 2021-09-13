<template>
  <v-card elevation="5" style="flex: 1">
    <v-card-title class="font-weight-thin"
      ><span class="ma-auto">Référentiel</span></v-card-title
    >
    <v-expansion-panels focusable class="mb-6 pa-5">
      <v-expansion-panel v-for="item in list" :key="item.id">
        <v-expansion-panel-header expand>
          {{ item.name }}
          <template v-slot:actions>
            <span v-if="!isNaN(item.moyenne)">{{ item.moyenne }}</span>
            <span v-if="isNaN(item.moyenne)">-</span>
            <v-icon> mdi-arrow-down </v-icon>
          </template>
        </v-expansion-panel-header>
        <v-expansion-panel-content class="pt-5 pb-5">
          <v-row v-for="competence in item.competences" :key="competence.id">
            <v-col cols="8"
              ><span class="competences-title">
                {{ competence.description }}
              </span>
            </v-col>
            <v-col class="text-right text-xs-center" cols="4">
              <span class="competences-notes" v-if="!isNaN(competence.note)">{{
                competence.note
              }}</span>
              <span class="competences-notes" v-if="isNaN(competence.note)"
                >-</span
              >
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