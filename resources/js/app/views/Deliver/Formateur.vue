<template>
<div>
      <v-container fluid>
                <v-tabs
                    v-model="tab"
                    background-color="transparent"
                    color="basil"
                    class="pa-2"
                >
                    <div class="d-flex row justify-space-between">
                        <div class="d-flex row pa-2">
                            <v-tab
                                v-for="item in menus"
                                :key="item.title"
                                class="pa-2 text-center btn-style-2"
                            >
                                {{ item.title }}
                            </v-tab>
                        </div>
</div>
                </v-tabs>
      </v-container>

<v-tabs-items v-model="tab">

   <v-tab-item
                    v-for="item in menus"
                    :key="item.title"
                >
<div v-if="item.title === 'tags'" class="column col-md-12">
 <v-dialog transition="dialog-bottom-transition" class="col-8" v-model="ajout">
      <template v-slot:activator="{ on, attrs }">
            <v-btn color="success" class="col-1" icon v-bind="attrs" v-on="on">
              <v-icon> mdi-plus </v-icon>
            </v-btn>
        </template>

      
    <v-card>
                 <v-toolbar color="orange" dark>Ajouter un tag</v-toolbar>
                       <v-text-field
                                    v-model="nomTag"
                                    label="nom du tag"
                                    
                                ></v-text-field>
                                <v-btn
                                    @click="addTag"
                                >
                                Ajouter
                                </v-btn>
    </v-card>

</v-dialog>
<v-list>

<v-list-item  v-for="(item, i) in tags" :key="i" >


           <v-list-item-content class="row col-10">
              <v-list-item-title v-text="item.nom" class="col-6"></v-list-item-title>
        
  
 <v-dialog transition="dialog-bottom-transition" class="col-4" v-model="dialog">
      <template v-slot:activator="{ on, attrs }">
            <v-btn color="success" class="col-1" icon v-bind="attrs" :tags="item" @click="editTag(item)" v-on="on">
              <v-icon> mdi-pencil-round </v-icon>
            </v-btn>
        </template>

    <v-card>
            <v-toolbar color="orange" dark>Modifier un tag</v-toolbar>
                       <v-text-field
                                    v-model="nomTag"
                                    label="nom du tag"
                                    :value="nomTag"
                                ></v-text-field>
                                <v-btn
                                    @click="updateTag"
                                >
                                    Modifier
                                </v-btn>
    </v-card>
</v-dialog>
<v-btn icon class="col-1"  @click="supprimerTag(item.id)" > <v-icon> mdi-minus </v-icon> </v-btn>
            </v-list-item-content>
</v-list-item>
</v-list>



    </div>
    <div v-if="item.title === 'competences'" class="row col-md-12">

competences

    </div>
</v-tab-item>
</v-tabs-items>
</div>
</template>

<script src="./js/Formateur.js" />