<template>
    <v-dialog transition="dialog-bottom-transition" max-width="650px" min-width="400px" v-model="dialog">
        <template v-slot:activator="{ on, attrs }">
            <v-btn icon :color="color_btn" class="" text v-bind="attrs" v-on="on">
              <v-icon>  {{ button }} </v-icon>
            </v-btn>
        </template>
        <FlashMessage />
         <v-card>
            <v-toolbar color="orange" dark> {{ card_title }} de</v-toolbar>
            <v-card-text>
                <v-container grid-list-xs>

                    <div class="d-flex flex-wrap">
                        <v-text-field v-model="titre" label="titre" class="mr-2"></v-text-field>
                        <v-text-field v-model="extrait" label="extrait" ></v-text-field>
                    </div>
                    
                    <div class="d-flex flex-wrap">
                        

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
                        <v-select v-model="technos" :items="techno_items" attach chips label="techno" multiple class="mr-3"></v-select>
                        <v-select v-model="tags" :items="tags_items" attach chips label="Compétence" multiple></v-select>
                    </div>

                    <Editor @set_description="set_description" :description="description" />
                    
                    <div class="d-flex justify-center">
                        <v-btn small block color="success" @click="create_update">Ajouter</v-btn>
                    </div>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script src="./js/projet_modal.js"></script>
