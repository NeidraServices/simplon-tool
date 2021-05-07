<template>
    <div>
        <v-text-field v-on:keyup="searchKeyword" v-model="textSearch" placeholder="Recherche par mots clés...">
        </v-text-field>
    </div>
</template>

<script>

import Axios from "axios";

export default {
    components: {
    },
    data(){
        return{
            textSearch: '',
        }
    },

    methods:{
        searchKeyword(){
            if (val && val.length > 1) {
                this.loading = true
                apiCall.search(val).then(
                    ({ data }) => {
                    this.loading = false;
                    data.data.forEach(categorie => {
                        this.categories.push(this.formattedCategorie(categorie))
                    });
                });
            }
        },
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

}
</script>

<style>

</style>