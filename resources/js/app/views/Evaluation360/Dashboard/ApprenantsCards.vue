<template>
  <v-container>
    <v-row class="d-flex flex-wrap">
      <v-col
        v-for="apprenant in apprenants"
        :key="apprenant.id"
        class="ma-auto d-flex"
        md="6"
        cols="12"
        xs="12"
        sm="6"
        lg="4"
      >
        <v-card
          shaped
          max-width="300"
          min-width="270"
          height="100px"
          class="ma-auto d-flex flex-wrap"
          elevation="5"
        >
          <div class="apprenants-avatar">
            <img :src="getImages(apprenant.avatar)" />
          </div>
          <div class="apprenants-infos">
            <h3>{{ apprenant.name }} {{ apprenant.surname }}</h3>
            <span>CDA</span>
            <h4>8/10</h4>
            <v-btn class="see-more" icon to="details">
              <v-icon> mdi-eye</v-icon>
            </v-btn>
          </div>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script src="./apprenantsCards.js"/>
<style>
.apprenants-avatar {
  width: 100px;
  height: 100%;
  position: relative;
  left: -15%;
}
.apprenants-avatar img {
  width: 100%;
  height: 100%;
  position: absolute;
  border-radius: 50%;
}
.apprenants-infos {
  padding: 10px;
}
.apprenants-infos .see-more {
  position: absolute;
  right: 0;
  bottom: 0;
  padding: 5px;
}
</style>