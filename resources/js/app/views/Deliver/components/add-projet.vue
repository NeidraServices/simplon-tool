<template>
    <v-dialog transition="dialog-bottom-transition" max-width="auto" v-model="dialog">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="success" icon v-bind="attrs" v-on="on">
              <v-icon> mdi-plus </v-icon>
            </v-btn>
        </template>

         <v-card>
            <v-toolbar color="orange" dark>Ajouter un projet</v-toolbar>
            <v-card-text>
                <v-container grid-list-xs>
                    <div class="d-flex flex-wrap">
                        <v-text-field v-model="titre" label="titre" ></v-text-field>

                        <v-menu ref="menu" v-model="menu" :close-on-content-click="false" :return-value.sync="deadline">
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    v-model="deadline"
                                    label="deadline"
                                    prepend-icon="mdi-calendar"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker v-model="deadline" no-title scrollable>
                                <v-spacer></v-spacer>
                                <v-btn text color="primary" @click="menu = false"> Cancel </v-btn>
                                <v-btn text color="primary" > OK </v-btn>
                            </v-date-picker>
                        </v-menu>

                        <v-menu ref="menu" v-model="menu_" :close-on-content-click="false" :return-value.sync="deadline">
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    v-model="presentation"
                                    label="presentation"
                                    prepend-icon="mdi-calendar"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker v-model="presentation" no-title scrollable>
                                <v-spacer></v-spacer>
                                <v-btn text color="primary" @click="menu_ = false"> Cancel </v-btn>
                                <v-btn text color="primary" > OK </v-btn>
                            </v-date-picker>
                        </v-menu>
                    </div>
                    
                    <div class="d-flex flex-wrap justify-space-around">
                        <v-select v-model="techno" :items="techno_items" attach chips label="techno" multiple class="mr-3"></v-select>
                        <v-select v-model="tags" :items="tags_items" attach chips label="Compétence" multiple></v-select>
                    </div>

                    <v-file-input v-model="image" truncate-length="15" label="Image de couverture"></v-file-input>   

                    <div class="d-flex flex-wrap justify-space-around">
                        <v-textarea  background-color="grey lighten-2 col-12" label="Description" height="100%" v-model="description"></v-textarea>
                        <v-img src="https://ma.ambafrance.org/IMG/arton11404.png?1565272504" class="col" max-width="100%" ></v-img>
                    </div>

                    <editor />
                    
                    <div class="d-flex justify-center">
                        <v-btn small block color="success" @click="add_project">Ajouter</v-btn>
                    </div>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script src="./js/add-projet.js"></script>
