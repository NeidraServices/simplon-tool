<template>
  <v-container>
    <h1>Sondage sur USER</h1>
    <v-card>
      <v-row>
        <v-col cols="12" lg="6">
          <h4 class="pa-5">Langues</h4>
          <v-row class="pa-5">
            <v-col cols="12" lg="2" class="font-weight-thin text-center">
              Langue 1</v-col
            >
            <v-col cols="12" lg="10">
              <v-row>
                <v-col cols="2">
                  <v-card class="sondage-langages-notes d-flex">
                    <img :src="getImages('langages/flutter.png')" />
                  </v-card>
                </v-col>
                <v-col cols="8">
                  <v-progress-linear
                    class="sondage-progress-bar"
                    v-model="note"
                    color="#bce9f7"
                    height="25"
                    @change="updateNote"
                  >
                    <strong>{{ displayNote }}/ 10</strong></v-progress-linear>
                </v-col>
              </v-row>
            </v-col></v-row
          >
        </v-col>
        <v-divider vertical></v-divider>
        <v-col cols="12" lg="6">
          <h4 class="pa-5">Commentaires</h4>
          <v-textarea></v-textarea
        ></v-col>
      </v-row>
    </v-card>
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
</style>