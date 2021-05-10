<template>
  <div>
    <v-list nav dense v-if="userRole == 2">
      <v-list-item link to="/evaluation360/cohorte">
        <v-list-item-title>Gestion compte apprenants</v-list-item-title>
      </v-list-item>
      <v-list-item link to="/evaluation360/gestion/sondages">
        <v-list-item-title>Gestion sondage</v-list-item-title>
      </v-list-item>
      <v-list-item link to="/evaluation360/apprenants">
        <v-list-item-title>Profils des apprenants</v-list-item-title>
      </v-list-item>
      <v-list-item link to="/evaluation360/sondages">
        <v-list-item-title>Tout les sondages</v-list-item-title>
      </v-list-item>
    </v-list>

    <v-list nav dense v-if="userRole == 3">
      <!-- content menu for learner -->
    </v-list>
  </div>
</template>

<script src="./menuEval.js" />