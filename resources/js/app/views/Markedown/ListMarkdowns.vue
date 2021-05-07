<template>
  <div>
    <v-container>
      <CustomFlashMessage ref="customFlash"/>
      <v-row justify="space-between">
        <v-col cols="12">
            <v-card-title
                class="layout justify-center mb-6"
            >
                LES MARKDOWS COMMUNS
            </v-card-title>
            <v-card-text
                class="layout justify-center"
            >
            <v-row justify="space-between">
                <v-col class="layout justify-center justify-md-start align-center col-12 col-xs-4 col-md-4 col-lg-4 col-xl-4">
                  <AutocompleteCategorie @select="getMdByCategory"/>
                    <v-icon @click="clearFilter" class="clear-button justify-center" color="red">mdi-close</v-icon>
                </v-col>

                <v-col class="layout justify-center align-center col-12 col-xs-4 col-md-4 col-lg-4 col-xl-4">
                  <AutocompleteCategorie/><!-- Aremplacer par la barre de recherche -->
                </v-col>
                <v-col class="layout justify-center justify-md-end align-center col-12 col-xs-4 col-md-4 col-lg-4 col-xl-4">
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
          <v-row
            no-gutters
            class="justify-center"
          >
          <v-col
              class="col-12 col-xs-6 col-md-6 col-lg-4 col-xl-3"
              v-for="item in markdown_list"
              :key="item.id"
              @click="goTo(item)"
              style="max-width: 460px;"
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
  import Utils from '../../helpers/utils';
  import Axios from "axios";
  const utils = new Utils();
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
            category : ""
        };
    },
    mounted() {
     this.getMdCommuns();
    },
    methods: {
        getMdCommuns() {
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
        displayClear(){
            document.getElementsByClassName('clear-button').css('display', 'none');
        },
        clearFilter(){
           this.getMdCommuns();
        },
        getByCategory(){
            if (this.category !== ""){
                Axios.get(`${location.origin}/api/markedown/markdown/category/${this.category}`).then( response => {
                    this.markdown_list =   this.formatDataMdCom(response.data.data);
                })
            }
        },
        getMdByCategory: function (id) {
            this.category = id;
            this.getByCategory();
        },
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
                    author: utils.formatName(item.user.surname, item.user.name)
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
  .clear-button{
      margin-top: auto;
  }
</style>
