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

                       <v-btn color="orange" icon>
                        <v-icon>
                            mdi-pencil-circle
                        </v-icon>                           
                       </v-btn>
                   </v-col>
               </v-card-title>
                
                <v-col cols="12">
                    <v-img src="https://ma.ambafrance.org/IMG/arton11404.png?1565272504" width="100%" height="auto"></v-img>
                </v-col>

                <div class="pb-5">
                    <p class="text-center my-0">{{ projet.formateur.name }}</p>
                    <p class="text-center my-0">{{ projet.deadline}}</p>
                </div>
           </v-card>
       </div>
    </v-container>
</template>

<script src="./js/home.js"></script>
