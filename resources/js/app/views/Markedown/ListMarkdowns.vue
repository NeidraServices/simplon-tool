<template>
  <div>
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
                <v-col cols="3" xs="6" class="layout justify-flex-start">
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
                <v-col cols="6" xs="6" class="layout justify-center">
                    <v-autocomplete></v-autocomplete>
                </v-col>
                <v-col cols="3" xs="6" class="layout justify-flex-end">  
                <v-spacer></v-spacer>    
                <router-link to="/markedowns/mymarkedowns" custom v-slot="{ navigate }">
                    <v-btn 
                        @click="navigate"
                        @keypress.enter="navigate" 
                        role="link"
                    >
                        Mes Markdown
                    </v-btn>
                </router-link>
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
  </div>
</template>
<script>
  import ItemMdCommun from "./component/ItemMdCommun";
  import {APIService} from './Services/ServiceRecupCateg'
  export default {
    name: "ListMarkdowns",
    components: {
      ItemMdCommun
    },
    data() {
        return {
          markdown_list: [
            ],
          categories: [
            
          ]
        };
    },
    mounted() {
      const apiCall = new APIService()
      apiCall.getApiMdCommuns().then(
        reponse => {
          console.log("Reponse :", reponse)
          this.markdown_list = this.formatDataMdCom(reponse.data)
        }
      )
    },
    methods: {
      formatDataMdCom(data){
        let formatedData = []
        if(Array.isArray(data)){
            data.map(item => {
                formatedData.push({
                    id: item.id,
                    category: item.id,
                    title: item.url,
                    author: "user"+item.user_id
                })
            })
        }        
        return formatedData
      },
      recupCateg(){
        const apiCall = new APIService()
        apiCall.getApiCategories().then(
          reponse => {
            console.log("Reponse :", reponse)
          }
        )
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