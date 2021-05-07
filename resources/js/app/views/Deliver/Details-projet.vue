<template>
  <div @voir-projet="getData">
    <template>
      <v-card-title class="text-center justify-center py-6">
        <h1 class="font-weight-bold">
          {{ projet.titre }}
        </h1>
      </v-card-title>

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

            <v-dialog v-model="dialog" persistent max-width="600px">
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  color="primary"
                  dark
                  v-bind="attrs"
                  v-on="on"
                  class="btn-style-1"
                >
                  Ajout d'un apprenant
                </v-btn>
              </template>
              <v-card>
                <v-card-title>
                  <span class="headline">Ajout d'un apprenant</span>
                </v-card-title>
                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col cols="12">
                        <v-text-field
                          label="Ajout d'un apprenant par son E-mail"
                          required
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-autocomplete
                          :items="[
                            'Skiing',
                            'Ice hockey',
                            'Soccer',
                            'Basketball',
                            'Hockey',
                            'Reading',
                            'Writing',
                            'Coding',
                            'Basejump',
                          ]"
                          label="Ajout d'un apprenant"
                          multiple
                        ></v-autocomplete>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="red darken-1" text @click="dialog = false">
                    Fermer
                  </v-btn>
                  <v-btn color="blue darken-1" text @click="dialog = false">
                    Valider
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
            <v-dialog v-model="dialogRendu" persistent max-width="600px">
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  color="primary"
                  dark
                  v-bind="attrs"
                  v-on="on"
                  class="btn-style-1"
                >
                  Soumettre mon rendu
                </v-btn>
              </template>
              <v-card>
                <v-card-title>
                  <span class="headline">Soumettre mon rendu</span>
                </v-card-title>
                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col cols="12">
                        <v-text-field
                          label="Lien GitHub"
                          required
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          label="Lien du site en ligne"
                          required
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          label="Technologie utilisé"
                          required
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-file-input
                          accept="image/*"
                          label="Ajout de média"
                          multiple
                        ></v-file-input>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="red darken-1" text @click="dialogRendu = false">
                    Fermer
                  </v-btn>
                  <v-btn
                    color="blue darken-1"
                    text
                    @click="dialogRendu = false"
                  >
                    Valider
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </div>
        </v-tabs>
      </v-container>

      <v-tabs-items v-model="tab">
        <v-tab-item v-for="item in menus" :key="item.title">
          <div v-if="item.title === 'Détail'" class="row col-md-12">
            <v-card color="basil" flat class="col-md-8">
              <v-card-text> <b>Techno utilisée.s :</b><br /> </v-card-text>
              <v-card-text> <b>Référentiel :</b><br /> </v-card-text>
              <v-card-text>
                <b>Description :</b><br />
                {{ projet.description }}
              </v-card-text>
              <v-card-text>
                <b>Apprenants :</b><br />
                <ul v-for="item in apprenants" :key="item.id">
                  <li>{{ item.name }} {{ item.surname }}</li>
                </ul>
              </v-card-text>
            </v-card>
            <v-card color="basil" flat class="col-md-4">
              <v-card-text>
                <b>Deadline : </b>
                {{ projet.deadline }}
              </v-card-text>
            </v-card>

            <div class="column col-12">
              <v-textarea v-model="commentaire" background-color="teal accent-1"> </v-textarea>

              <v-btn @click="addCom"> Ajouter commentaire</v-btn>

              <v-card v-for="com in commentaires" color="blue-grey lighten-5 mb-2" :key="com.id">
                <v-card-title>
                  {{ com["user"]}} <v-card-subtitle> {{ com["created_at"] | formatDate }} </v-card-subtitle>
                </v-card-title> 
                {{ com.text }}           
         
                     <v-dialog
                transition="dialog-bottom-transition"
                max-width="600px"
                v-model="dialogRep"
              >
                <template v-slot:activator="{ on, attrs }">
           
             <v-btn outlined rounded text v-bind="attrs" @click="setComid(com.id)" :comId="com.id" v-on="on"> repondre </v-btn>
                </template>

                <v-card>
  
     <v-textarea v-model="reponseCom" background-color="teal accent-1"> </v-textarea>
                  <v-btn @click="repondreCom"> repondre </v-btn>
                </v-card>
              </v-dialog>
             
                <div v-if="com.reponses">
                
                  <v-card v-for="rep in com.reponses" color="green lighten-3" :key="rep.id" class="mb-5 col-10 offset-2">
                    <v-card-title>
                      {{ rep["user"] }}  <v-card-subtitle> {{ rep["created_at"] | formatDate }} </v-card-subtitle>
                    </v-card-title>
                    {{ rep.text }}
                  </v-card>
                  
                </div>
              </v-card>
            </div>
          </div>
          <div class="d-flex row pa-3" v-if="item.title === 'Liste des rendus'">
            <v-card
              class="ma-3"
              width="450"
              outlined
              v-for="item in apprenants"
              :key="item.id"
            >
              <v-list-item>
                <v-list-item-content>
                  <div class="overline mb-4">
                    {{ item.name }} {{ item.surname }}
                  </div>
                  <v-list-item-title class="headline mb-1">
                    Techno utilisé
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>

              <v-card-actions class="d-flex align-center justify-space-between">
                <v-btn outlined rounded text> Lien site web </v-btn>
                <v-btn outlined rounded text> Lien GitHub </v-btn>
                <!-- :to="{name: '/deliver/mesprojets/rendu/', params: { id: 1}}" -->
                <router-link to="/deliver/mesprojets/rendu/1">
                  <v-btn outlined rounded text> Détails </v-btn>
                </router-link>
              </v-card-actions>
            </v-card>
          </div>
        </v-tab-item>
      </v-tabs-items>
    </template>
  </div>
</template>

<script src="./js/Details-projets.js"></script>

<style>
.btn-style-1 {
  height: auto !important;
  margin-right: 25px !important;
}

.btn-style-2 {
  height: auto;
  margin-left: 25px;
}
</style>
