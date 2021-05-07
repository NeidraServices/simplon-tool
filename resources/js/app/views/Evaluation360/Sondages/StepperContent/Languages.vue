<template>
  <v-container>
    <v-card elevation="0">
      <v-row>
        <v-col cols="12" lg="12">
          <v-row class="pa-5 d-flex flex-wrap">
            <v-col
              cols="12"
              lg="6"
              v-for="language in Languages"
              :key="language.id"
            >
              <v-col cols="12 ma-auto text-center">
                <span class="font-weight-thin">
                  {{ language.langage.name }}
                </span>
              </v-col>
              <ProgressBar :language="language.langage" />
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-card>
    <div class="stepper-actions">
      <v-btn color="primary" @click="next()"> Continuer </v-btn>

      <v-btn text @click="e1 = 1"> retour </v-btn>
    </div>
  </v-container>
</template>
<script src="./languages.js"/>