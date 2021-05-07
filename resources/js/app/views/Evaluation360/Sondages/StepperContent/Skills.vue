<template>
  <v-container>
    <v-card elevation="0">
      <v-row>
        <v-col cols="12" lg="12">
          <v-row class="pa-5 d-flex flex-wrap">
            <v-col
              class="pa-5"
              cols="12"
              lg="6"
              v-for="skill in skills"
              :key="skill.id"
            >
              <v-col cols="12 ma-auto text-left">
                <span class="font-weight-thin">
                  {{ skill.skill.description }}
                </span>
                <v-col cols="12" lg="12">
                  <ProgressBar :skill="skill.skill" />
                </v-col>
              </v-col>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-card>
    <div class="stepper-actions">
      <v-btn color="primary" @click="next()"> Valider </v-btn>

      <v-btn text @click="e1 = 2"> retour </v-btn>
    </div>
  </v-container>
</template>
<script src="./skills.js"/>