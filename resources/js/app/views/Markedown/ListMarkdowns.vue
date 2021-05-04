<template>
  <MainLayout>
    <template v-slot:content-slot>
      <v-content>
        <v-container fluid>
          <v-row justify="space-between">
            <v-col cols="12">
                <v-card-title 
                    class="layout justify-center"
                >
                    LES MARKDOWS COMMUNS
                </v-card-title>
                <v-card-text 
                    class="layout justify-center"
                >
                <v-row justify="space-between">
                    <v-col cols="3" class="layout justify-flex-start">
                       <v-autocomplete
                          v-model="recupCateg"
                          :items="categories"
                          outlined
                          dense
                          chips
                          small-chips
                          label="Catégories"
                          multiple
                       >

                       </v-autocomplete>
                    </v-col>
                    <v-col cols="6" class="layout justify-center">
                        <v-autocomplete></v-autocomplete>
                    </v-col>
                    <v-col cols="3" class="layout justify-flex-end">
                        <v-btn 
                            type="button"
                        >
                            Mes Markdown
                        </v-btn>
                    </v-col>
                </v-row>
                </v-card-text>
            </v-col>
            <v-divider></v-divider>
            <div class="item-container">
              <v-col
                  v-for="item in markdown_list"
                  :key="item.id"
              >  
                <ItemMdCommun 
                   v-bind:item="item"
                />
              </v-col>
            </div>
            
          </v-row>
        </v-container>
      </v-content>
    </template>

    <template v-slot:lien1>
     <span>Lien 1</span>
    </template>

    <template v-slot:lien2>
     <span>Lien 2</span>
    </template>
  </MainLayout>
</template>

<script>
  import MainLayout from "../../layouts/MainLayout";
  import ItemMdCommun from "./component/ItemMdCommun";
  import {APIService} from './Services/ServiceRecupCateg'
  export default {
    name: "ListMarkdowns",
    components: {
      MainLayout,
      ItemMdCommun
    },
    data() {
        return {
          markdown_list: [
              {id: 1, title:"Titre 1",author: "Auteur1", category: "catégorie1"},
              {id: 2, title:"Titre 2",author: "Auteur2", category: "catégorie2"},
              {id: 3, title:"Titre 3",author: "Auteur3", category: "catégorie3"},
              {id: 4, title:"Titre 4",author: "Auteur4", category: "catégorie4"},
              {id: 5, title:"Titre 5",author: "Auteur5", category: "catégorie5"}
            ],
          categories: [
            
          ]
        };
    },
    mounted() {
      const apiCall = new APIService()
      apiCall.getApiCategories().then(
        reponse => {
          console.log("Reponse :", reponse)
        }
      )
    },
    methods: {
      recupCateg(){
        console.log("categ")
      },
      search(){
        console.log("Valll")
      }
    }
  };
</script>
<style>
  .item-container {
    width: 100%;
  }
  .divider {
    margin: 5px;
  }
</style>