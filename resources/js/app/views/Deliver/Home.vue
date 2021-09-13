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
                    <ProjetTemplate :user="user" :projet="projet" @delete_projet="delete_projet" @append_projet="append_projet" />
                </div>
           </div>
        </div>
</template>

<script src="./js/home.js"></script>
