<template>
    <div>
        <v-banner
            :sticky="sticky"
        >
            <div class="row justify-space-between">
                <div class="pa-5">
                    <v-btn
                        class="ma-2"
                        color="light primary"
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
                <div class="pa-5">
                    <h2 v-if="projet">{{ projet.titre }}</h2>
                </div>
            </div>


            <template v-slot:actions>
               <v-dialog
                    v-model="dialog"
                    persistent
                    max-width="600px"
                >
                <template v-slot:activator="{ on, attrs }">
                     <v-btn
                        text
                        v-bind="attrs"
                        v-on="on"
                        color="deep-purple accent-4"
                    >
                        Modifier
                    </v-btn>
                </template>
                <v-card>
                    <v-card-title>
                    <span class="headline">User Profile</span>
                    </v-card-title>
                    <v-card-text>
                    <v-container>
                        <v-row>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                            label="Legal first name*"
                            required
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                            label="Legal middle name"
                            hint="example of helper text only on focus"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                            label="Legal last name*"
                            hint="example of persistent helper text"
                            persistent-hint
                            required
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                            label="Email*"
                            required
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                            label="Password*"
                            type="password"
                            required
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                        >
                            <v-select
                            :items="['0-17', '18-29', '30-54', '54+']"
                            label="Age*"
                            required
                            ></v-select>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                        >
                            <v-autocomplete
                            :items="['Skiing', 'Ice hockey', 'Soccer', 'Basketball', 'Hockey', 'Reading', 'Writing', 'Coding', 'Basejump']"
                            label="Interests"
                            multiple
                            ></v-autocomplete>
                        </v-col>
                        </v-row>
                    </v-container>
                    <small>*indicates required field</small>
                    </v-card-text>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="dialog = false"
                    >
                        Close
                    </v-btn>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="dialog = false"
                    >
                        Save
                    </v-btn>
                    </v-card-actions>
                </v-card>
                </v-dialog>
            </template>
        </v-banner>

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
