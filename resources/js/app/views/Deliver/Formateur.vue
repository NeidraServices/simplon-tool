<template>
  <div>
    <v-container fluid>
      <v-tabs
        v-model="tab"
        background-color="transparent"
        color="basil"
        class="pa-2"
      >
        <div class="d-flex row justify-space-between">
          <div class="d-flex row pa-2">
            <v-tab
              v-for="item in menus"
              :key="item.title"
              class="pa-2 text-center btn-style-2"
            >
              {{ item.title }}
            </v-tab>
          </div>
        </div>
      </v-tabs>
    </v-container>

    <v-tabs-items v-model="tab">
      <v-tab-item v-for="item in menus" :key="item.title">
        <div v-if="item.title === 'tags'" class="column col-md-12">
          <v-dialog
            transition="dialog-bottom-transition"
            class="col-8"
            v-model="ajoutTag"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                color="success"
                class="col-1 mb-2"
                icon
                v-bind="attrs"
                v-on="on"
              >
                <v-icon> mdi-plus </v-icon>
              </v-btn>
            </template>

            <v-card>
              <v-toolbar color="orange" dark>Ajouter un tag</v-toolbar>
              <v-text-field
                v-model="nomTag"
                label="nom de la compétence"
              ></v-text-field>
              <v-btn @click="addTag"> Ajouter </v-btn>
            </v-card>
          </v-dialog>
          <v-card
            v-for="(item, i) in tags"
            :key="i"
            class="row col-10 space-between"
          >
            <span class="col-4"> {{ item.nom }} </span>
            <div>
              <v-dialog
                transition="dialog-bottom-transition"
                max-width="600px"
                v-model="dialog"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-btn color="orange" icon v-bind="attrs" @click="editTag(item)" v-on="on">
              <v-icon> mdi-pencil-circle </v-icon>
            </v-btn>
                </template>

                <v-card>
                  <v-toolbar color="orange" dark>Modifier un tag</v-toolbar>
                  <v-text-field
                    v-model="nomTag"
                    label="nom du tag"
                    :value="nomTag"
                  ></v-text-field>
                  <v-btn @click="updateTag"> Modifier </v-btn>
                </v-card>
              </v-dialog>
              <v-btn icon class="col-1" @click="supprimerTag(item.id)">
                <v-icon> mdi-minus </v-icon>
              </v-btn>
            </div>
          </v-card>
        </div>

        <div v-if="item.title === 'competences'" class="column col-md-12">
          <v-dialog
            transition="dialog-bottom-transition"
            class="col-8"
            v-model="ajoutComp"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                color="success"
                class="col-1 mb-2"
                icon
                v-bind="attrs"
                v-on="on"
              >
                <v-icon> mdi-plus </v-icon>
              </v-btn>
            </template>

            <v-card>
              <v-toolbar color="orange" dark>Ajouter une competence</v-toolbar>
              <v-text-field
                v-model="nomComp"
                label="nom de la compétence"
              ></v-text-field>
              <v-btn @click="addComp"> Ajouter </v-btn>
            </v-card>
          </v-dialog>
          <v-card
            v-for="(item, i) in competences"
            :key="i"
            class="row col-10 space-between"
          >
            <span class="col-4"> {{ item.nom }} </span>
            <div>
              <v-dialog
                transition="dialog-bottom-transition"
                max-width="600px"
                v-model="dialog"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-btn color="orange" icon v-bind="attrs" @click="editComp(item)" v-on="on">
              <v-icon> mdi-pencil-circle </v-icon>
            </v-btn>
                </template>

                <v-card>
                  <v-toolbar color="orange" dark
                    >Modifier une compétence</v-toolbar
                  >
                  <v-text-field
                    v-model="nomComp"
                    label="nom de la compétence"
                    :value="nomComp"
                  ></v-text-field>
                  <v-btn @click="updateComp"> Modifier </v-btn>
                </v-card>
              </v-dialog>
              <v-btn icon class="col-1" @click="supprimerComp(item.id)">
                <v-icon> mdi-minus </v-icon>
              </v-btn>
            </div>
          </v-card>
        </div>
      </v-tab-item>
    </v-tabs-items>
  </div>
</template>

<script src="./js/Formateur.js" />