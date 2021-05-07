<template>
  <v-container>
    <v-row class="d-flex">
      <v-col cols="12" v-for="question in questions" :key="question.id">
        <v-col cols="12 text-center">
          <span class="font-weight-light">{{ question.question }}</span>
        </v-col>
        <v-col class="ma-auto" cols="12" lg="6">
          <v-form v-model="valid" :lazy-validation="lazy">
            <v-textarea
              solo
              outlined
              required
              v-model="description[`${question.id}`]"
              name="question"
              label="Réponse ..."
              @input="update(question)"
            ></v-textarea>
          </v-form>
        </v-col>
      </v-col>
    </v-row>

    <div class="stepper-actions">
      <v-btn color="primary" :disabled="!valid" @click="next()">
        Continuer
      </v-btn>
    </div>
  </v-container>
</template>
<script src="./questions.js"/>