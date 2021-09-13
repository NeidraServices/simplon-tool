<template>
  <v-card elevation="5" style="flex: 1; height: max-content">
    <v-card-title class="font-weight-thin"
      ><span class="ma-auto">Langages</span></v-card-title
    >
    <v-row class="pa-5">
      <v-hover v-slot="{ hover }" v-for="langage in langues" :key="langage.id">
        <v-col class="pa-5" xs="12" sm="6" md="4" lg="3" xl="2" cols="12"
          ><v-card
            :elevation="hover ? 5 : 2"
            class="langages-card ma-auto d-flex flex-wrap"
            height="100"
            max-width="150"
          >
            <img class="langage-icon" :src="getImages(langage.image)" />
            <v-card
              width="50px"
              height="50px"
              class="langages-note"
              :elevation="hover ? 5 : 2"
            >
              <span v-if="langage.note">{{ langage.note }}</span>
              <span v-if="!langage.note">n/a</span>
            </v-card>
          </v-card>
        </v-col>
      </v-hover>
    </v-row>
  </v-card>
</template>
<script src="./langagesCards.js"/>
<style>
.langage-icon {
  height: 50%;
  width: 50%;
  margin: auto;
  object-fit: contain;
}
.langages-card .langages-note {
  border-radius: 100% !important;
  position: absolute;
  padding: 10px;
  right: -30px;
  bottom: -2vh;
  display: flex;
}
.langages-card .langages-note span {
  margin: auto;
}
</style>