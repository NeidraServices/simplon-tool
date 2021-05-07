<template>
  <v-container
    fluid
    class="containerAttribute d-flex justify-center align-center flex-column"
  >
    <div class="mt-10">
      <h1 class="text-center">
        Veuillez choisir l'application que vous voulez consulter
      </h1>
    </div>

    <div style="width: 100% !important" class="my-10">
      <v-row
        no-gutters
        class="justify-space-around my-10"
        style="width: 100% !important"
      >
        <v-col
          cols="12"
          lg="4"
          md="4"
          v-for="project in projectCard"
          :key="project.name"
          class="d-flex justify-space-around"
        >
          <div style="width: 100% !important" class="d-flex justify-center">
            <v-hover v-slot="{ hover }">
              <v-card
                width="340"
                class="my-5"
                :elevation="hover ? 6 : 3"
                @click="goToProject(project.path)"
              >
                <v-card-text>
                  <h3 class="text-center"> {{ project.name }} </h3>
                  <div class="text--primary text-center mt-5">
                    {{ project.description }}
                  </div>
                </v-card-text>
                <v-card-actions class="d-flex justify-center pb-5">
                  <v-btn class="white--text" x-small color="blue accent-4"> Accéder </v-btn>
                </v-card-actions>
              </v-card>
            </v-hover>
          </div>
        </v-col>
      </v-row>
    </div>
  </v-container>
</template>

<script src="./js/home.js"></script>

<style>
.containerAttribute {
  width: 100% !important;
  height: 80% !important;
}
</style>