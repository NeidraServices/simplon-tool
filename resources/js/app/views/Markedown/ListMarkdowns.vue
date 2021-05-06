<template>
  <div>
    <v-container fluid>
      <CustomFlashMessage ref="customFlash"/>
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
          <v-row>
          <v-col              
              class="col-12 col-xs-6 col-md-6 col-lg-4 col-xl-3"
              v-for="item in markdown_list"
              :key="item.id"
              @click="goTo(item)"
          >
            <ItemMdCommun
                v-bind:item="item"
            />
          </v-col>
          </v-row>
        </div>

      </v-row>
    </v-container>
  </div>
</template>
<script>
  import ItemMdCommun from "./component/ItemMdCommun";
  import AutocompleteCategorie from "./component/AutocompleteCategorie";
  import {APIService} from './Services/Services';
import CustomFlashMessage from "./component/CustomFlashMessage";
  const apiCall = new APIService()

  export default {
    name: "ListMarkdowns",
    components: {
      ItemMdCommun,
      AutocompleteCategorie,
      CustomFlashMessage
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
          this.markdown_list = this.formatDataMdCom(reponse.data.data)
        }
      ).catch (error => {
          console.log(error)
          this. $refs.customFlash.showMessageError(error)
      })
    },
    methods: {
        goTo(item){
            this.$router.push({ name: 'ShowReadMd', params: {id: item.id.toString()}})
        },
      formatDataMdCom(data){
        let formatedData = []
        if(Array.isArray(data)){
            data.map(item => {
                formatedData.push({
                    id: item.id,
                    category: item.category.name,
                    description: item.description,
                    title: item.title,
                    author: item.user.name
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
