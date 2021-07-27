<template>
  <div>
    <v-container>
      <v-row>
        <v-col cols="12">
            <v-card-title
                class="layout justify-center mb-6"
            >
                Archives
            </v-card-title>
            <v-card-text
                class="layout justify-center"
            >
              <v-row class="layout justify-center justify-md-end">
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
              <ItemArchive
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
  import ItemArchive from '../../component/ItemArchive';
  import {APIService} from '../../Services/Services'
  import Utils from '../../../../helpers/utils';
  const utils = new Utils();
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
          this.markdown_list = this.formatDataArchives(reponse.data.data)
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
                    category: item.markdown.category.name,
                    title: item.markdown.title,
                    description: item.markdown.description,
                    date: utils.formatDate(item.updated_at ? item.updated_at : ((item.created_at) ? item.created_at : null))
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
