<template>
    <v-dialog transition="dialog-bottom-transition" max-width="600">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="orange" icon v-bind="attrs" v-on="on">
              <v-icon> mdi-minus </v-icon>
            </v-btn>
        </template>


        <template v-slot:default="dialog">
          <v-card>
            <v-toolbar color="orange" dark>Supprimer le projet</v-toolbar>
            <v-card-text>
              <div class="text-h2 pa-12">Hello world!</div>
            </v-card-text>

            <v-card-actions class="justify-end">
                 <v-btn text @click="dialog.value = false">
                  Close
                </v-btn>
            </v-card-actions>
          </v-card>
        </template>
      </v-dialog>
</template>

<script src="./js/delete-projet.js"></script>
