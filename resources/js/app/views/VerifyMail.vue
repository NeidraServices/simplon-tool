<template>
  <div
    class="d-flex justify-center align-center"
    style="height: 100% !important"
  >
    <v-card class="mx-auto" width="500">
      <v-card-text>
        <h3
          class="font-weight-medium text-center"
          :class="isVerified ? 'red--text' : 'green--text'"
        >
          {{ message }}
        </h3>
      </v-card-text>

      <v-card-actions class="d-flex justify-center">
        <div class="mr-2">
          <v-btn
            small
            to="/"
            class="grey darken-1 mr-3 white--text font-weight-medium"
          >
            retour
          </v-btn>
        </div>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script src="./js/verify.js"></script>
