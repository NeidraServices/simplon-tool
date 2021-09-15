<template>
    <v-container>
        <template>
            <v-card-title class="text-center justify-center py-6" >
                <h1 class="font-weight-bold">
                    {{ projet.titre }}
                </h1>
            </v-card-title>

            <v-container fluid>
                <v-tabs v-model="tab" background-color="transparent" color="basil"  class="pa-2">
                    <div class="d-flex row justify-end">
                        <v-dialog
                            v-model="dialog"
                            persistent
                            max-width="600px"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn
                                v-if="currentUser.role.name == 'formateur'"
                                    v-bind="attrs"
                                    v-on="on"
                                    small
                                    class="btn-style-1 border-radius-25"
                                    color="green darken-1"
                                    text
                                >
                                    Ajout d'un apprenant
                                </v-btn>
                            </template>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">Ajout d'un apprenant</span>
                                </v-card-title>
                                <v-form>
                                    <v-card-text>
                                        <v-autocomplete v-model="apprenants" :items="allApprenants" label="Ajout d'un apprenant" item-value="name" multiple hide-no-data return-object>
                                            <template v-slot:selection="data">
                                                <v-chip v-bind="data.attrs" :input-value="data.selected" @click="data.select" >
                                                    {{ data.item.name }} {{ data.item.surname }}
                                                </v-chip>
                                            </template>
                                            <template v-slot:item="data">
                                                <template v-if="typeof data.item !== 'object'">
                                                    <v-list-item-content v-text="data.item"></v-list-item-content>
                                                </template>
                                                <template v-else>
                                                    <v-list-item-content>
                                                        <v-list-item-content v-html="data.item.name + ' ' + data.item.surname"></v-list-item-content>
                                                    </v-list-item-content>
                                                </template>
                                            </template>
                                        </v-autocomplete>
                                    </v-card-text>
                                    <v-card-actions>
                                                <v-spacer></v-spacer>
                                        <v-btn
                                            color="red darken-1"
                                            text
                                            @click="dialog = false"
                                        >
                                            Fermer
                                        </v-btn>
                                        <v-btn
                                            color="blue darken-1"
                                            text
                                            @click="submit(apprenants)"
                                        >
                                            Valider
                                        </v-btn>
                                    </v-card-actions>
                                </v-form>
                            </v-card>
                        </v-dialog>
                        <v-dialog
                            v-model="dialogRendu"
                            persistent
                            max-width="600px"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn
                                    small
                                    v-bind="attrs"
                                    v-on="on"
                                    class="btn-style-1 border-radius-25"
                                    color="green darken-1"
                                    text
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
                                            <v-col
                                                cols="12"
                                            >
                                                <v-text-field
                                                    label="Lien GitHub"
                                                    v-model="rendu['github_url']"
                                                    required
                                                ></v-text-field>
                                            </v-col>
                                            <v-col
                                                cols="12"
                                            >
                                                <v-text-field
                                                    label="Lien du site en ligne"
                                                     v-model="rendu['site_url']"
                                                    required
                                                ></v-text-field>
                                            </v-col>
                                            <v-col
                                                cols="12"
                                            >
                                                <v-text-field
                                                    label="Technologie utilisé"
                                                     v-model="rendu['technos']"
                                                    required
                                                ></v-text-field>
                                            </v-col>
                                            <v-col
                                                cols="12"
                                            >
                                                <v-file-input
                                                    accept="image/*"
                                                    label="Ajout de média"
                                                    v-model="rendu['medias']"
                                                    multiple
                                                ></v-file-input>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="red darken-1"
                                        text
                                        @click="dialogRendu = false"
                                    >
                                        Fermer
                                    </v-btn>
                                    <v-btn
                                        color="blue darken-1"
                                        text
                                        
                                        @click="setRendu()"
                                    >
                                        Valider
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </div>
                </v-tabs>
            </v-container>
            <v-container fluid>
                <v-expansion-panels>
                    <v-expansion-panel>
                        <v-expansion-panel-header>
                            <h2 class="pa-2">Détails</h2>
                        </v-expansion-panel-header>
                        <v-expansion-panel-content>
                            <v-row>
                                <v-col cols="8">
                                    <v-card
                                        color="basil"
                                        flat
                                        class="col-md-8"
                                    >
                                        <v-card-text>
                                            <b>Techno utilisée.s :</b><br />
                                        </v-card-text>
                                        <v-card-text>
                                            <b>Référentiel :</b><br />
                                        </v-card-text>
                                        <v-card-text>
                                            <b>Description :</b><br />
                                            <p v-html="projet.description"></p>
                                        </v-card-text>
                                        <v-card-text>
                                            <b>Apprenants :</b><br />
                                            <ul
                                                v-for="item in apprenants"
                                                :key="item.id"
                                            >
                                                <li>
                                                    {{ item.name }} {{ item.surname }}
                                                </li>
                                            </ul>
                                        </v-card-text>
                                    </v-card>
                                </v-col>
                                <v-col cols="4">
                                    <v-card
                                        color="basil"
                                        flat
                                    >
                                        <v-card-text>
                                            <b>Deadline : </b>
                                            {{ projet.deadline }}
                                        </v-card-text>
                                        <v-card-text>
                                            <b>Date de presentation : </b>
                                            {{ projet.date_presentation }}
                                        </v-card-text>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-expansion-panels>
            </v-container>
            <v-container fluid>
                <div class="d-flex row pa-2">
                    <h2>Liste des rendus :</h2>
                </div>
                <v-container fluid class="d-flex row">
                    <v-col cols="4"
                           class="pa-2"
                           v-for="item in rendu"
                           :key="item.id"
                    >
                        <v-card
                            class="ma-3"
                            width="450"
                            outlined
                        >
                            <v-list-item>
                                <v-list-item-content>
                                    <div class="overline mb-4">
                                        {{ item.user.name }} {{ item.user.surname }}
                                    </div>
                                    <v-list-item-title class="headline mb-1">
                                        Techno utilisé
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>

                            <v-card-actions class="d-flex align-center justify-space-between">
                                <v-btn
                                    outlined
                                    rounded
                                    small
                                    text
                                    link
                                    :href="item.rendu.site_url"
                                >
                                    Lien site web
                                </v-btn>
                                <v-btn
                                    outlined
                                    small
                                    rounded
                                    text
                                    link
                                    :href="item.rendu.github_url"
                                >
                                    Lien GitHub
                                </v-btn>
                                <router-link :to="`/deliver/mesprojets/rendu/${item.rendu.id}`" >
                                    <v-btn outlined small rounded text> Détails </v-btn>
                                </router-link>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-container>
            </v-container>
        </template>
    </v-container>
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

.border-radius-25 {
    border-radius: 25%;
}
</style>
