<template>
    <div>
        <v-autocomplete
            :loading="loading"
            :items="categories"
            :search-input.sync="search"
            item-text="composed"
            append-icon=""
            prepend-inner-icon="mdi-magnify"
            return-object
            cache-items
            hide-no-data
            hide-details
            label="Catégorie">
        </v-autocomplete>
    </div>
</template>

<script>

  import {APIService} from '../Services/Services';
  const apiCall = new APIService()
  export default {
    name: "AutocompleteCategorie",
    data() {
        return {
          categories: [],
          search: null,
          loading: false,
        };
    },
    watch: {
      search: function (val) {
        if (val && val.length > 1) {
          this.loading = true
          apiCall.search(val).then(
            ({ data }) => {
            this.loading = false;
              data.data.forEach(categorie => {
                  this.$emit('select', categorie.id)
                  this.categories.push(this.formattedCategorie(categorie))
              });
          });
        }
      },
    },
    methods: {
      formattedCategorie: function (categorie) {
        return {
            composed: categorie.name,
        }
      },
    }
  };
</script>
