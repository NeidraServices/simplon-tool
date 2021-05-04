<template>
    <v-container>
       <h2>Tous les projets</h2>

       <div v-for="projet in projets" :key="projet.id">
           <v-card>
               <v-card-title primary-title>
                   <v-col cols="6">
                       {{ projet.titre }}
                   </v-col>
                   <v-col>
                       
                   </v-col>
               </v-card-title>
           </v-card>
       </div>
    </v-container>
</template>

<script src="./js/home.js"></script>
