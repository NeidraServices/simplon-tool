<template>
    <v-card min-width="300" max-width="344" shaped class="my-4">
        <v-card-title>
            <v-col cols="6">
                {{ projet.titre }}
            </v-col>
            <v-col cols="6" class="text-end" v-if="user.role.name !== 'apprenant'">
                <projet_ModalDelete :project_id="projet.id" @delete_projet="delete_projet" />
                <Modal_projet @append_projet="append_projet" :projet="projet"/>
            </v-col>
        </v-card-title>
            
            <v-col cols="12">
                <v-card-text>
                    {{ projet.extrait }}
                </v-card-text>
            </v-col>

            <div class="d-flex justify-space-around mt-5">
                <p class="text-center"> {{ projet.formateur_id.name}} {{ projet.deadline}}</p>
                <v-btn x-small color="success" class="mt-1" @click="voir_projet(projet.id)" outlined>ouvrir</v-btn>
            </div>
    </v-card>
</template>


<script src="./js/projet_template.js" />