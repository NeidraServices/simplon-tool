<template>
    <div>
        <div>
            <v-container :class="{'px-0': $vuetify.breakpoint.xsOnly }">
                <div class="d-flex justify-center">
                    <h1>{{ projet != null ? projet.titre : 'Titre' }}</h1>
                </div>
            </v-container>

            <!-- <v-checkbox
            v-model="v0"
            label="Visible"
            ></v-checkbox> -->
            <v-banner
            v-model="v0"
            single-line
            transition="slide-y-transition"
            >
            <router-link
                :to="(projet != null ? '/deliver/projet/' + projet.id : '#' )"
            >
                <v-btn
                    class="ma-2"
                    color="primary"
                    text
                    dark
                >
                    <v-icon
                    dark
                    left
                    >
                    mdi-arrow-left
                    </v-icon>Retour
                </v-btn>
            </router-link>
            <template v-slot:actions>
                <!-- <v-btn
                text
                color="primary"
                >
                Modifier
                </v-btn> -->
                <v-dialog
                transition="dialog-bottom-transition"
                max-width="600px"
                v-model="dialog"
                >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn color="orange" icon v-bind="attrs" @click="test(mediasEditor)" v-on="on">
                        <v-icon> mdi-pencil-circle </v-icon>
                    </v-btn>
                </template>

                <v-card class="pa-5">
                  <v-toolbar color="orange" dark>Modifier un tag</v-toolbar>
                  <div class="pa-8">
                    <v-text-field
                        v-model="githubUrl"
                        label="Lien github"
                        :value="githubUrl"
                    ></v-text-field>
                    <v-text-field
                        v-model="siteUrl"
                        label="Lien Site Web"
                        :value="siteUrl"
                    ></v-text-field>
                    <v-file-input
                        multiple
                        label="Ajouter un media"
                    ></v-file-input>
                    <div class="ma-5 ctn">
                        <template>
                            <v-container class="pa-4 text-center">
                                <v-row
                                class="fill-height"
                                align="center"
                                justify="center"

                                >
                                <template v-for="media in mediasEditor">
                                    <v-col
                                    :key="media.id"
                                    cols="12"
                                    md="4"
                                    >
                                    <v-hover v-slot="{ hover }">
                                        <v-card
                                        :elevation="hover ? 12 : 2"
                                        :class="{ 'on-hover': hover }"
                                        height="225"
                                        dark
                                        >
                                        <v-img
                                            contain
                                            height="225px"
                                            :src="media.lien"
                                            :lazy-src="media.lien"
                                        >
                                            <v-card-title class="title white--text">
                                            <v-row
                                                class="fill-height flex-column"
                                                justify="space-between"
                                            >

                                                <div class="align-self-center">
                                                <v-btn
                                                    v-for="(icon, index) in icons"
                                                    :key="index"
                                                    :class="{ 'show-btns': hover }"
                                                    :color="transparent"
                                                    icon
                                                >
                                                    <v-icon
                                                    :class="{ 'show-btns': hover }"
                                                    :color="transparent"
                                                    >
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
                    <v-btn @click="editRendu"> Modifier </v-btn>
                  </div>
                </v-card>

              </v-dialog>
            </template>
            </v-banner>
        </div>

        <template>
            <v-card
                class="ma-10"
                max-width="400"
                tile
            >
                <v-list-item four-line v-if="user">
                    <v-list-item-content>
                        <v-list-item-title>Informations</v-list-item-title>
                        <v-list-item-subtitle class="text-capitalize">
                            {{ user.name }} <span class="text-uppercase">{{ user.surname }}</span>
                        </v-list-item-subtitle>
                        <v-list-item-subtitle>
                            _Technologie_utilisé_
                        </v-list-item-subtitle>
                        <v-list-item-subtitle>
                            _Référentiel_
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-card>
        </template>

        <div class="ma-10">
            <v-list-item>
                <v-list-item-content>
                    <!-- <v-list-item-title>Lien du site web</v-list-item-title> -->
                    <v-list-item-subtitle>
                        <v-btn
                            tile
                            color="primary"
                            :href="(rendu != null ? rendu.github_url : $route.name)" target="_blank"
                            >
                            <v-icon left>
                                mdi-web
                            </v-icon>
                            Site Web
                        </v-btn>
                    </v-list-item-subtitle>
                    <v-list-item-subtitle>
                    <v-btn
                            tile
                            color="primary"
                            :href="(rendu != null ? rendu.site_url : $route.name)" target="_blank"
                            >
                            <v-icon left>
                                mdi-git
                            </v-icon>
                            Github
                        </v-btn>
                    </v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
        </div>

        <div>
            <v-item-group>
                <v-container>
                <v-row v-if="rendu">
                    <v-col
                    v-for="media in rendu.medias"
                    :key="media.id"
                    cols="12"
                    md="4"
                    >
                    <v-item>
                        <a
                            :href="media.lien"
                            target="_blank"
                        >
                        <v-card
                        class="d-flex align-center"
                        height="350"
                        >
                            <v-img
                                contain
                                height="350"
                                :src="media.lien"
                                :lazy-src="media.lien"
                                class="grey lighten-2"
                            >
                                <template v-slot:placeholder>
                                <v-row
                                    class="fill-height ma-0"
                                    align="center"
                                    justify="center"
                                >
                                    <v-progress-circular
                                    indeterminate
                                    color="grey lighten-5"
                                    ></v-progress-circular>
                                </v-row>
                                </template>
                            </v-img>
                        </v-card>
                        </a>
                    </v-item>
                    </v-col>
                </v-row>
                </v-container>
            </v-item-group>
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
