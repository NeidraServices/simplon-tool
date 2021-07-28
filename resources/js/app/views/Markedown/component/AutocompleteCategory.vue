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
import {apiService} from "../../../services/apiService";

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
        search: async function (val) {
            if (val && val.length > 1) {
                this.loading = true
                let datas = await apiService.get(`${location.origin}/api/markedown/categorie/search`, {query: val})
                if (datas) {
                    this.loading = false;
                }
                datas.data.data.forEach(category => {
                    this.$emit('select', category.id)
                    this.categories.push(this.formattedCategorie(category))
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
