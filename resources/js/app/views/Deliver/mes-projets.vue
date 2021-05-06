<template>
    
        <div class="ml-5">
           
           <div class="d-flex flex-wrap justify-space-around">
                <div v-for="projet in projets" :key="projet.id" >
                    <v-card min-width="300" max-width="344">
                        <v-card-title>
                            <v-col cols="6">
                                {{ projet.titre }}
                            </v-col>
                        </v-card-title>
                            
                            <v-col cols="12">
                                <v-card-text>
                                    {{ projet.extrait }}
                                </v-card-text>
                            </v-col>

                            <div class="d-flex justify-space-around mt-5">
                                <p class="text-center"> {{ projet.deadline}}</p>
                                <v-btn x-small color="success" class="mt-1" @click="voir_projet(projet.id)" outlined>ouvrir</v-btn>
                            </div>
                    </v-card>
                </div>
           </div>

        </div>
</template>

<script src="./js/mes-projets.js"></script>