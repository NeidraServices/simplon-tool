<template>
    <div>
        <template>
            <v-card-title class="text-center justify-center py-6">
                <h1 class="font-weight-bold">
                    [NOM DU PROJET]
                </h1>
            </v-card-title>

            <v-tabs
                v-model="tab"
                background-color="transparent"
                color="basil"
            >
                <v-tab
                    v-for="item in menus"
                    :key="item.title"
                >
                    {{ item.title }}
                </v-tab>
            </v-tabs>

            <v-tabs-items v-model="tab">
                <v-tab-item
                    v-for="item in menus"
                    :key="item.title"
                >
                    <div v-if="item.title === 'Détail'">
                        <v-card
                            color="basil"
                            flat
                        >
                            <v-card-text>
                                <b>Techno utilisée.s</b>
                            </v-card-text>
                            <v-card-text>
                                <b>Référentiel</b>
                            </v-card-text>
                            <v-card-text>
                                <b>Description</b>
                            </v-card-text>
                        </v-card>
                    </div>
                    <div v-if="item.title === 'Liste des rendus'">
                        <v-card
                            color="basil"
                            flat
                        >
                            <v-card
                                class="mx-auto"
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

                                <v-card-actions class="d-flex align-center justify-center">
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
                        </v-card>
                    </div>
                </v-tab-item>
            </v-tabs-items>
        </template>
    </div>
</template>

<script src="./js/Details-projets.js"></script>
