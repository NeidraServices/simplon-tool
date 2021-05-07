<template>
    <div>
        <v-banner
            :sticky="sticky"
        >
            <div>
                <h2>titre_projet</h2>
                <v-btn
                    class="ma-2"
                    color="light darken-2"
                    dark
                >
                    <v-icon
                    dark
                    left
                    >
                    mdi-arrow-left
                    </v-icon>retour
                </v-btn>
            </div>


            <template v-slot:actions>
                <v-btn
                text
                color="deep-purple accent-4"
                >
                Modifier
                </v-btn>
            </template>
        </v-banner>

        <template>
            <v-card
                class="ma-10"
                max-width="400"
                tile
            >
                <v-list-item four-line>
                    <v-list-item-content>
                        <v-list-item-title>Informations</v-list-item-title>
                        <v-list-item-subtitle>
                            Nom et prénom de l'apprenant
                        </v-list-item-subtitle>
                        <v-list-item-subtitle>
                            Technologie utilisé
                        </v-list-item-subtitle>
                        <v-list-item-subtitle>
                            Référentiel
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-card>
        </template>

        <div class="d-flex row ma-10">
            <div class="col">
                <v-list-item>
                    <v-list-item-content>
                        <v-list-item-title>Lien du site web</v-list-item-title>
                        <v-list-item-subtitle>
                            <v-btn
                                tile
                                color="primary"
                                :href="(rendu != null ? rendu.github_url : $route.name)" target="_blank"
                                >
                                <v-icon left>
                                    mdi-web
                                </v-icon>
                                Voir
                            </v-btn>
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </div>
            <div class="col">
                <v-list-item>
                    <v-list-item-content>
                        <v-list-item-title>Lien du dépo github</v-list-item-title>
                        <v-list-item-subtitle>
                            <v-btn
                                tile
                                color="primary"
                                :href="(rendu != null ? rendu.site_url : $route.name)" target="_blank"
                                >
                                <v-icon left>
                                    mdi-git
                                </v-icon>
                                Voir
                            </v-btn>
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </div>
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
                        <v-card
                        class="d-flex align-center"
                        height="250"
                        >
                            <v-img
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
</style>
