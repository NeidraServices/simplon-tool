<template>
  <v-container fluid>
    <div
      style="z-index: 2000"
      class="d-flex justify-center align-center flex-column"
    >
      <div class="d-flex justify-start align-center mb-8">
        <h1 class="text-center">Liste des compétences</h1>
        <v-btn icon class="py-5 ml-5" @click="openGeneral">
          <v-icon color="green"> mdi-plus-circle-outline </v-icon>
        </v-btn>
      </div>

      <v-card width="900" class="mb-5">
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
          :items="skillList"
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
                  @click="openGeneral(item, true)"
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
                  @click="openDeleteDialog(item)"
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

    <v-dialog v-model="generalDialog" max-width="600" style="z-index: 2500">
      <v-card class="py-5">
        <v-card-title class="d-flex justify-center font-weight-bold">
          {{ title }}
        </v-card-title>
        <div class="d-flex justify-center">
          <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            style="width: 75% !important"
          >
            <v-text-field
              v-model="skillName"
              :rules="skillRefRules"
              label="Compétence"
              required
            ></v-text-field>

            <v-select
              v-model="selectSkillRef"
              :rules="skillRefRules"
              :items="referentielList"
              item-text="description"
              return-object
              item-value="id"
              persistent-hint
              label="Référentiel"
              required
            ></v-select>
          </v-form>
        </div>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            small
            class="grey darken-1 mr-3 white--text font-weight-medium"
            @click="closeGeneral"
            >Annuler</v-btn
          >
          <v-btn
            small
            class="blue white--text font-weight-medium"
            @click="handleSkill"
            >valider</v-btn
          >
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="deleteDialog" max-width="600" style="z-index: 2500">
      <v-card class="py-5">
        <v-card-title class="d-flex justify-center font-weight-bold">
          Voulez-vous vraiment supprimer cette compétence ?
        </v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            small
            class="grey darken-1 mr-3 white--text font-weight-medium"
            @click="closeDeleteDialog"
            >Annuler</v-btn
          >
          <v-btn
            small
            class="red white--text font-weight-medium"
            @click="deleteSkills"
            >Supprimer</v-btn
          >
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script src="./js/adminSkills.js"></script>