<template>
  <v-container>
    <div class="pa-5 more-header">
      <h1>{{ apprenant.name }} {{ apprenant.surname }}</h1>
      <span class="font-weight-thin">{{ apprenant.email }}</span>
    </div>
    <v-row class="ma-auto pa-5">
      <v-col class="d-flex" cols="12" xs="12" sm="12" md="12" lg="6" xl="6">
        <Referentiel :apprenant="apprenant" />
      </v-col>
      <v-col class="d-flex" cols="12" xs="12" sm="12" md="12" lg="6" xl="6">
        <Langages
          :langues="langagesList"
          :apprenant="apprenant"
          class="pb-5 pr-2"
        />
      </v-col>
    </v-row>
    <v-row>
      <v-col class="d-flex pa-5" cols="12" xs="12" sm="6" md="6" lg="6" xl="6">
        <v-btn color="white" rounded width="250" height="100" class="ma-auto">
          Derniers projets
        </v-btn>
      </v-col>
      <v-col class="d-flex pa-5" cols="12" xs="12" sm="6" md="6" lg="6" xl="6">
        <v-btn color="white" height="100" rounded width="250" class="ma-auto">
          Derniers markdown
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>
<script src="./seeMore.js"/>