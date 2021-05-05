<template>
    <v-dialog transition="dialog-bottom-transition" max-width="600" v-model="dialog">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="orange" icon v-bind="attrs" v-on="on">
              <v-icon> mdi-pencil-circle </v-icon>
            </v-btn>
        </template>

        <v-card>
            <v-toolbar color="orange" dark>Modifier le projet {{ projet.titre }} </v-toolbar>
            <v-card-text>
                <v-container grid-list-xs>
                    <v-text-field v-model="titre" label="titre" ></v-text-field>
                    <v-file-input v-model="image" truncate-length="15" label="Image de couverture"></v-file-input>   

                    <v-menu ref="menu" v-model="menu"
                            :close-on-content-click="false"
                            :return-value.sync="deadline"
                             transition="scale-transition"
                            offset-y
                            min-width="auto"
                    >
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
                        <v-date-picker
                        v-model="deadline"
                        no-title
                        scrollable
                        >
                            <v-spacer></v-spacer>
                            <v-btn
                                text
                                color="primary"
                                @click="menu = false"
                            >
                                Cancel
                            </v-btn>
                            <v-btn text color="primary" @click="$refs.menu.save(deadline)" >
                                OK
                            </v-btn>
                        </v-date-picker>
                    </v-menu>

                    <v-textarea background-color="grey lighten-2" label="Description"  v-model="description"></v-textarea>
                    <div class="d-flex justify-center">
                        <v-btn small block color="success" @click="update_projet">Modifier</v-btn>
                    </div>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script src="./js/projet-modal_update.js"></script>
