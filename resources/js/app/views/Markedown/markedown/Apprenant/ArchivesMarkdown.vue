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
  import {MdUtils} from '../../MdUtils/Utils'
  import {apiService} from "../../../../services/apiService";
  import Utils from "../../../../helpers/utils";
  const utils = new Utils();

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
        this.getArchives(this.id)
    },
    methods: {
        async getArchives(id){
            try{
                let response = await apiService.get(`${location.origin}/api/markedown/markdown/archives/${id}`)
                console.log(response)
                this.markdown_list = new MdUtils.FormatMdArchive(response.data.data)
            }catch (e) {
                console.log(e)
            }
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
