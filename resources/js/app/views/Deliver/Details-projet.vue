<template>
    <div>
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

                        <v-dialog
                            transition="dialog-top-transition"
                            max-width="600"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn
                                    color="primary"
                                    v-bind="attrs"
                                    v-on="on"
                                    class="btn-style-1"
                                >Ajout d'un apprenant</v-btn>
                            </template>
                            <template v-slot:default="dialog">
                                <v-card>
                                    <v-toolbar
                                        color="primary"
                                        dark
                                    >Ajout d'un apprenant</v-toolbar>
                                    <v-card-text>
                                        <v-text-field
                                            label="Ajout d'un apprenant par son E-mail"
                                            hide-details="auto"
                                        ></v-text-field>
                                        <v-select
                                            v-model="select"
                                            :hint="`${select.state}`"
                                            :items="items"
                                            item-text="state"
                                            label="Ajout d'un apprenant"
                                            persistent-hint
                                            return-object
                                            single-line
                                        ></v-select>
                                    </v-card-text>
                                    <v-card-actions class="justify-end">
                                        <v-row>
                                            <v-btn
                                                text
                                                @click="dialog.value = false"
                                            >
                                                Fermer
                                            </v-btn>
                                            <v-btn
                                                text
                                                color="primary"
                                            >
                                                Valider
                                            </v-btn>
                                        </v-row>
                                    </v-card-actions>
                                </v-card>
                            </template>
                        </v-dialog>
                    </div>
                </v-tabs>
            </v-container>

            <v-tabs-items v-model="tab">
                <v-tab-item
                    v-for="item in menus"
                    :key="item.title"
                >
                    <div v-if="item.title === 'Détail'" class="row col-md-12">
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
                                {{ projet.description }}
                            </v-card-text>
                        </v-card>
                        <v-card
                            color="basil"
                            flat
                            class="col-md-4"
                        >
                            <v-card-text>
                                <b>Deadline : </b>
                                {{ projet.deadline }}
                            </v-card-text>
                        </v-card>
                    </div>
                    <div class="d-flex row pa-3" v-if="item.title === 'Liste des rendus'">
                        <v-card
                            class="ma-3"
                            max-width="344"
                            outlined
                        >
                            <v-list-item>
                                <v-list-item-content>
                                    <div class="overline mb-4">
                                        [NOM APPRENANT]
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
                                    text
                                >
                                    Lien site web
                                </v-btn>
                                <v-btn
                                    outlined
                                    rounded
                                    text
                                >
                                    Lien GitHub
                                </v-btn>
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
