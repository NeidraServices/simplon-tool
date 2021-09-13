<template>
  <v-container>
    <h1 class="text-center mb-5">Tout les sondages</h1>
    <v-row>
      <v-col cols="12" lg="4" v-for="sondage in sondages" :key="sondage.id">
        <v-hover v-slot="{ hover }">
          <v-card shaped :elevation="hover ? 5 : 3" class="font-weight-thin">
            <v-card-title>{{ sondage.name }} </v-card-title>
            <v-card-text
              >Sondage portant sur {{ sondage.user.name }}
              {{ sondage.user.surname }}</v-card-text
            >
            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn
                text
                rounded
                color='#d14631'
                :to="
                  '/evaluation360/sondage/' + sondage.id + '/' + sondage.user.id
                "
              >
                <span><v-icon text>mdi-arrow-right</v-icon></span>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
  </v-container>
</template>
<script src="./sondagesList.js"/>