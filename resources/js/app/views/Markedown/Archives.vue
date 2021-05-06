<template>
  <div>
    <v-container fluid>
      <v-row justify="space-between">
        <v-col cols="12">
            <v-card-title 
                class="layout justify-center"
            >
                Archives ID:{{id}}
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
  import {APIService} from './Services/Services'
  const apiCall = new APIService()
  export default {
    name: "Archives",
    components: {
      ItemArchive
    },
    props: {
      id: {
          type: String
      }
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
      console.log("ID :", this.id)
      apiCall.getApiMyArchives(this.id).then(
        reponse => {
          console.log("Reponse :", reponse)
          this.markdown_list = this.formatDataArchives(reponse.data)
        }
      )
    },
    methods: {
      formatDataArchives(data){
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