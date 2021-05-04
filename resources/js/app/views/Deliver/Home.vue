<template>
    <v-container>
       <h2 class="my-10 mb-15">Tous les projets</h2>

       <div v-for="projet in projets" :key="projet.id">
           <v-card max-width="344">
               <v-card-title>
                   <v-col cols="6">
                       {{ projet.titre }}
                   </v-col>
                   <v-col cols="6" class="text-end" v-if="user.role != 'apprenant'">
                       <v-btn color="error" icon>
                        <v-icon>
                            mdi-minus
                        </v-icon>                           
                       </v-btn>

                       <projet_ModalUpdate />
                   </v-col>
               </v-card-title>
                
                <v-col cols="12">
                    <v-img src="https://ma.ambafrance.org/IMG/arton11404.png?1565272504" width="100%" height="auto"></v-img>
                </v-col>

                <div class="d-flex justify-space-around mt-5">
                    <p class="text-center">{{ projet.formateur.name }} {{ projet.deadline}}</p>
                    <v-btn x-small color="success" class="mt-1" outlined>ouvrir</v-btn>
                </div>
           </v-card>
       </div>
    </v-container>
</template>

<script src="./js/home.js"></script>
