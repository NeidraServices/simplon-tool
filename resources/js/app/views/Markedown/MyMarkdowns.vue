<template>
  <div>
    <v-container fluid>
      <CustomFlashMessage ref="customFlash"/>
      <v-row justify="space-between">
        <v-col cols="12">
            <v-card-title 
                class="layout justify-center"
            >
                MES MARKDOWNS
            </v-card-title>
            <v-card-text 
                class="layout justify-center"
            >
        <v-row >            
            <v-spacer></v-spacer>
            <BtnWithIcon v-bind:title="'Ajouter'" v-bind:routeName="'AddMarkdowns'">
                <v-icon
                    left
                    dark
                >
                  mdi-plus-thick
                </v-icon>
            </BtnWithIcon>
        </v-row>
            </v-card-text>
        </v-col>
        <v-divider></v-divider>
        <div class="item-container">
          <v-col
              v-for="item in markdown_list"
              :key="item.id"
              class="item"
          >  
            <ItemMyMd 
                v-bind:item="item"
                 @show-success-msg="showSuccessMsg" 
                 @show-error-msg="showErrorsMsg"
            />
          </v-col>
        </div>
        
      </v-row>
    </v-container>
  </div>
</template>
<script>
import ItemMyMd from "./component/ItemMyMd";
import BtnWithIcon from "./component/BtnWithIcon";
import MdEditor from "./component/MdEditor";
import {APIService} from './Services/Services'
import CustomFlashMessage from "./component/CustomFlashMessage";
const apiCall = new APIService()
export default {
    name: "MyMarkedDowns",
    components: {
        MdEditor,
        ItemMyMd,
        BtnWithIcon,
        CustomFlashMessage
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
      apiCall.getApiMyMds().then(
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
      formatDataMdCom(data){
        let formatedData = []
        if(Array.isArray(data)){
            data.map(item => {
                formatedData.push({
                    id: item.id,
                    category: item.md_category_id,
                    title: item.title,
                    status: item.status,
                    description: item.description,
                    author: "user"+item.user_id
                })
            })
        }        
        return formatedData
      },
      recupCateg(){
        apiCall.getApiCategories().then(
          reponse => {
            console.log("Reponse :", reponse)
          }
        )
        console.log("categ")
      },
      showSuccessMsg(msg){
        this.$refs.customFlash.showMessageSuccess(msg)
      },
      showErrorsMsg(msg){
        this.$refs.customFlash.showMessageError(msg)
      }
    }
  };
</script>
<style>
  .item-container {
    width: 100%;
  }
  .item:hover {
    cursor: pointer;
  }
  .divider {
    margin: 5px;
  }
</style>
