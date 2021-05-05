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
                  <AutocompleteCategorie/>      
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
  import AutocompleteCategorie from "./component/AutocompleteCategorie";
  import {APIService} from './Services/ServiceRecupCateg';
  const apiCall = new APIService()

  export default {
    name: "ListMarkdowns",
    components: {
      ItemMdCommun,
      AutocompleteCategorie
    },
    data() {
        return {
          markdown_list: [],
        };
    },
    mounted() {
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
                    category: item.md_category_id,
                    description: item.description,
                    title: item.title,
                    author: "user - "+item.user_id
                })
            })
        }        
        return formatedData
      },     
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