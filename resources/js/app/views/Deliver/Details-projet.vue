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
                            <v-card-text><b>Techno utilisée.s</b> {{ projet.techno }}</v-card-text>
                            <v-card-text><b>Référentiel</b> {{ projet.referentiel }}</v-card-text>
                            <v-card-text><b>Description</b> {{ projet.description }}</v-card-text>
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
                                <v-list-item three-line>
                                    <v-list-item-content>
                                        <div class="overline mb-4">
                                            OVERLINE
                                        </div>
                                        <v-list-item-title class="headline mb-1">
                                            Headline 5
                                        </v-list-item-title>
                                        <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
                                    </v-list-item-content>

                                    <v-list-item-avatar
                                        tile
                                        size="80"
                                        color="grey"
                                    ></v-list-item-avatar>
                                </v-list-item>

                                <v-card-actions>
                                    <v-btn
                                        outlined
                                        rounded
                                        text
                                    >
                                        Button
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
