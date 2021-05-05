<template>
  <div>
    <v-container fluid>
      <v-row justify="space-between">
        <v-col cols="12">
            <v-card-title 
                class="layout justify-center"
            >
                Archives
            </v-card-title>
            <v-card-text 
                class="layout justify-center"
            >
            <v-row>
                <v-spacer></v-spacer>
                <router-link to="/markedowns/mymarkedowns" custom v-slot="{ navigate }">
                    <v-btn 
                        class="ma-2"
                        @click="navigate"
                        @keypress.enter="navigate" 
                        role="link"
                    >
                        Mes Markdown
                    </v-btn>
                </router-link>
            </v-row>
            </v-card-text>
        </v-col>
        <v-divider></v-divider>
        <div class="item-container">
          <v-col
              v-for="item in markdown_list"
              :key="item.id"
          >  
            <ItemArchive 
                v-bind:item="item"
            />
          </v-col>
        </div>
        
      </v-row>
    </v-container>
  </div>
</template>
<script>
  import ItemArchive from "./component/ItemArchive";
  import {APIService} from './Services/ServiceRecupCateg'
  export default {
    name: "Archives",
    components: {
      ItemArchive
    },
    data() {
        return {
          markdown_list: [
            ],
          categories: [
            
          ],
        };
    },
    mounted() {
      const apiCall = new APIService()
      apiCall.getApiMyArchives().then(
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
                    title: item.title,
                    description: item.description,
                    date: item.updated_at ? item.updated_at : ((item.created_at) ? item.created_at : "Date "+item.id)
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