<template>
    <v-dialog transition="dialog-bottom-transition" max-width="450" v-model="dialog">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="error" icon v-bind="attrs" v-on="on">
              <v-icon> mdi-minus </v-icon>
            </v-btn>
        </template>

        <v-card>
            <v-toolbar color="orange" dark>Supprimer le projet</v-toolbar>
            <div class="d-flex justify-space-around my-5">
                <v-btn x-small color="error">Supprimer le projet</v-btn>
                <v-btn x-small color="success" @click="(dialog = false)">Ne pas supprimer le projet</v-btn>
            </div>
            <v-divider></v-divider>
        </v-card>
    </v-dialog>
</template>

<script src="./js/delete-projet.js"></script>
