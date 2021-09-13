<template>
        <div class="ml-5">
            <div class="d-flex  my-10">
                 <h2 class="col-8">Tous les projets</h2>
                 <v-col v-if="user.role.name != 'apprenant'">
                 <Modal_projet @append_projet="append_projet" :projet="null" />
                 </v-col>
                 <!-- <projet_ModalAdd class="col-4" :user="user" @append_projet="append_projet" /> -->
            </div>
           
           <div class="d-flex flex-wrap justify-space-around">
                <div v-for="projet in projets" :key="projet.id" >
                    <v-card min-width="300" max-width="344" shaped class="my-4">
                        <v-card-title>
                            <v-col cols="6">
                                {{ projet.titre }}
                            </v-col>
                            <v-col cols="6" class="text-end" v-if="user.role.name != 'apprenant'">
                                <projet_ModalDelete :project_id="projet.id" @delete_projet="delete_projet" />
                                <Modal_projet @append_projet="append_projet" :projet="projet"/>
                                <!-- <projet_ModalUpdate :projet="projet"/> -->
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
                </div>
           </div>
        </div>
</template>

<script src="./js/home.js"></script>
