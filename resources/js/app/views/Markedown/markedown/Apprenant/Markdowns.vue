<template>
  <div>
    <v-container>
      <CustomFlashMessage ref="customFlash"/>
      <v-row justify="space-between">
        <v-col cols="12">
            <v-card-title
                class="layout justify-center mb-6"
            >
                MES MARKDOWNS
            </v-card-title>
            <v-card-text
                class="layout justify-center"
            >
        <div class="layout justify-center justify-md-end">
            <!-- <v-spacer></v-spacer> -->
            <BtnWithIcon v-bind:title="'Ajouter'" v-bind:routeName="'AddMarkdowns'">
                <v-icon
                    left
                    dark
                >
                  mdi-plus-thick
                </v-icon>
            </BtnWithIcon>
        </div>
            </v-card-text>
        </v-col>
        <v-divider></v-divider>
        <div class="item-container">
          <v-row
            no-gutters
            class="justify-center"
          >
            <v-col
                v-for="item in markdown_list"
                :key="item.id"
                class="item col-12 col-xs-6 col-md-6 col-lg-4 col-xl-3"
                style="max-width: 460px;"
            >
              <ItemMyMd
                  v-bind:item="item"
                  @show-success-msg="showSuccessMsg"
                  @show-error-msg="showErrorsMsg"
              />
            </v-col>
          </v-row>
        </div>

      </v-row>
    </v-container>
  </div>
</template>
<script>
import ItemMyMd from "../../component/UserMdCards.vue";
import BtnWithIcon from "../../component/buttons/BtnWithIcon";
import MdEditor from "../../component/MdEditor";
import {APIService} from '../../Services/Services'
import CustomFlashMessage from "../../component/CustomFlashMessage";
import {apiService} from "../../../../services/apiService";
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
      this.getMyMarkdowns()
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
      async getMyMarkdowns(){
          try{
              let myMarkdowns = await apiService.get(`${location.origin}/api/markedown/markdown/showMine`)
              this.markdown_list = this.formatDataMdCom(myMarkdowns.data.data)
          }catch (error) {
            console.log(error)
            this. $refs.customFlash.showMessageError(error)
        }
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
  .item {
    max-width: 460px;
  }
  .divider {
    margin: 5px;
  }
</style>
