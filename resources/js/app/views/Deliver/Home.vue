<template>
    
        <div class="ml-5">
            <div class="d-flex justify-space-around my-10">
                 <h2 >Tous les projets</h2>
                 <v-btn color="success" icon>
                     <v-icon>mdi-plus</v-icon>
                 </v-btn>
            </div>
           
           <div class="d-flex flex-wrap justify-space-around">
                <div v-for="projet in projets" :key="projet.id" >
                    <v-card max-width="344">
                        <v-card-title>
                            <v-col cols="6">
                                {{ projet.titre }}
                            </v-col>
                            <v-col cols="6" class="text-end" v-if="user.role != 'apprenant'">
                                <projet_ModalDelete :project_id="projet.id" @delete_projet="delete_projet" />
                                <projet_ModalUpdate :projet="projet"/>
                            </v-col>
                        </v-card-title>
                            
                            <v-col cols="12">
                                <v-img src="https://ma.ambafrance.org/IMG/arton11404.png?1565272504" width="100%" height="auto"></v-img>
                            </v-col>

                            <div class="d-flex justify-space-around mt-5">
                                <p class="text-center"> {{ projet.deadline}}</p>
                                <v-btn x-small color="success" class="mt-1" outlined>ouvrir</v-btn>
                            </div>
                    </v-card>
                </div>
           </div>

        </div>
</template>

<script src="./js/home.js"></script>
