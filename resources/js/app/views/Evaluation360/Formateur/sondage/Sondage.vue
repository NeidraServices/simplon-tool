<template>
  <v-container
    class="d-flex justify-center align-center"
    style="height: 70% !important"
  >
    <v-dialog v-model="createdDialog" max-width="600">
      <v-card class="py-5">
        <v-card-title class="d-flex justify-center font-weight-bold">
          Créer un sondage
        </v-card-title>
        <div class="d-flex justify-center">
          <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            style="width: 85% !important"
          >
            <v-btn
              text
              outlined
              class="d-flex justify-center align-center mx-auto my-5"
              @click="addLines"
            >
              <div>
                <span>Ajouter une ligne</span>
              </div>
              <div class="ml-4">
                <v-icon color="green"> mdi-plus-circle-outline </v-icon>
              </div>
            </v-btn>

            <v-text-field
              label="Nom du sondage"
              v-model="sondageName"
              :rules="sondageNameRules"
            />

            <v-select
              v-model="published"
              :rules="publishedRules"
              :items="etatList"
              item-text="label"
              item-value="id"
              persistent-hint
              single-line
              label="Etat - Publié ou Brouillon"
              required
            ></v-select>

            <v-row
              no-gutters
              class="justify-center"
              v-for="(lines, key) in sondageLines"
              :key="key"
            >
              <v-col cols="12" lg="3" md="3" class="d-flex justify-center mr-2">
                <v-select
                  v-model="lines.langage_id"
                  placeholder="Choisir un langage"
                  :items="selectLangages"
                  item-text="name"
                  item-value="id"
                  label="Langage"
                  persistent-hint
                  single-line
                  required
                >
                </v-select>
              </v-col>

              <v-col cols="12" lg="7" md="7" class="d-flex justify-center">
                <v-select
                  v-model="lines.skill_id"
                  placeholder="Choisir une compétence"
                  :items="selectSkills"
                  item-text="description"
                  item-value="id"
                  label="Competence"
                  persistent-hint
                  single-line
                  required
                >
                </v-select>
              </v-col>
            </v-row>
          </v-form>
        </div>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            small
            class="grey darken-1 mr-3 white--text font-weight-medium"
            @click="closeAddModal"
            >Annuler</v-btn
          >
          <v-btn
            small
            class="blue white--text font-weight-medium"
            :disabled="disabled"
            @click="createSondage"
            >valider</v-btn
          >
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <div>
      <div class="d-flex justify-start align-center mb-8">
        <h1 class="text-center">Liste des sondages</h1>
        <v-btn icon class="py-5 ml-5" @click="openAddModal">
          <v-icon color="green"> mdi-plus-circle-outline </v-icon>
        </v-btn>
      </div>

      <v-card width="900" class="mx-auto">
        <v-card-title>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Rechercher"
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>

        <v-data-table
          :loading="!isLoaded"
          loading-text="Chargement en cours..."
          :headers="headers"
          :items="sondagesList"
          :search="search"
          locale="fr"
        >
          <template v-slot:item.actions="{ item }">
            <v-tooltip top>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  icon
                  small
                  v-bind="attrs"
                  v-on="on"
                  class="transparent blue-grey--text mr-2"
                >
                  <v-icon> mdi-eye </v-icon>
                </v-btn>
              </template>
              <span>Voir</span>
            </v-tooltip>

            <v-tooltip top>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  icon
                  small
                  v-bind="attrs"
                  v-on="on"
                  class="transparent blue-grey--text mr-2"
                >
                  <v-icon> mdi-square-edit-outline </v-icon>
                </v-btn>
              </template>
              <span>Modifier</span>
            </v-tooltip>

            <v-tooltip top>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  icon
                  small
                  class="transparent red--text"
                  v-bind="attrs"
                  v-on="on"
                >
                  <v-icon> mdi-delete </v-icon>
                </v-btn>
              </template>
              <span>Supprimer</span>
            </v-tooltip>
          </template>
        </v-data-table>
      </v-card>
    </div>
  </v-container>
</template>

<script src="./js/sondage.js"></script>