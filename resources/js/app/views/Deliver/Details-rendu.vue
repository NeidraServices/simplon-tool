<template>
    <div>
        <div>
            <v-container :class="{'px-0': $vuetify.breakpoint.xsOnly }">
                <div class="d-flex justify-center">
                    <h1 class="text-md-h3 text-xs-h5 text-center"> {{ projet != null ? projet.titre : 'Titre' }} - Rendu de {{ user.name + ' ' + user.surname }}</h1>
                </div>
            </v-container>

            <v-banner v-model="v0" single-line transition="slide-y-transition">
            <router-link :to="(projet != null ? '/deliver/projet/' + projet.id : '#' )">
                <v-btn class="ma-2" color="primary"  text dark> <v-icon dark left>mdi-arrow-left</v-icon> Retour</v-btn>
            </router-link>
            <template v-slot:actions>
                <v-dialog transition="dialog-bottom-transition" max-width="600px" v-model="dialog">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn color="orange" icon v-bind="attrs" @click="test(medias)" v-on="on">
                        <v-icon> mdi-pencil-circle </v-icon>
                    </v-btn>
                </template>

                <v-card>
                  <v-toolbar color="orange" dark>Modifier un tag</v-toolbar>
                  <div class="pa-8">
                    <v-text-field @keyup="editRendu" v-model="rendu.github_url" label="Lien github" :value="githubUrl"></v-text-field>
                    <v-text-field @keyup="editBtn = true" v-model="rendu.site_url" label="Lien Site Web" :value="siteUrl"></v-text-field>
                    <input type="file" change="selectImage" multiple ref="inputFile" />
                    <div class="ma-5 ctn">
                        <template>
                            <v-container class="pa-4 text-center">
                                <v-row class="fill-height" align="center" justify="center">
                                <template v-for="media in medias">
                                    <v-col :key="media.id" cols="12" md="4" >
                                    <v-hover v-slot="{ hover }">
                                        <v-card :elevation="hover ? 12 : 2" :class="{ 'on-hover': hover }" height="225" dark >
                                        <v-img contain height="225px" :src="media.lien" :lazy-src="media.lien" >
                                            <v-card-title class="title white--text">
                                            <v-row class="fill-height flex-column" justify="space-between" >
                                                <div class="align-self-center">
                                                <v-btn v-for="(icon, index) in icons" :key="index" :class="{ 'show-btns': hover }" :color="transparent" icon @click="remove(media)">
                                                    <v-icon :class="{ 'show-btns': hover }" :color="transparent">
                                                    {{ icon }}
                                                    </v-icon>
                                                </v-btn>
                                                </div>
                                            </v-row>
                                            </v-card-title>
                                        </v-img>
                                        </v-card>
                                    </v-hover>
                                    </v-col>
                                </template>
                                </v-row>
                            </v-container>
                        </template>
                    </div>
                    <v-btn v-if="editBtn" @click="editRendu"> Modifier </v-btn>
                  </div>
                </v-card>

              </v-dialog>
            </template>
            </v-banner>
        </div>
    </div>
</template>

<script src="./js/Details-rendu.js"></script>

<style>
.btn-style-1 {
    height: auto !important;
    margin-right: 25px !important;
}

.btn-style-2 {
    height: auto;
    margin-left: 25px;
}
a {
    text-decoration: none;
}
.ctn .v-card {
  transition: opacity .4s ease-in-out;
}

.ctn .v-card:not(.on-hover) {
  opacity: 0.6;
 }

.show-btns {
  color: rgba(255, 255, 255, 1) !important;
}
</style>
