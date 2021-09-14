<template>
    <div>
        <v-container>
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

                            <v-col
                                class="layout justify-center justify-md-start align-center col-12 col-xs-4 col-md-4 col-lg-4 col-xl-4">
                                <AutocompleteCategorie @select="getMdByCategory"/>
                                <v-icon @click="clearFilter" class="mb-5 clear-button justify-center" color="red">
                                    mdi-close-circle
                                </v-icon>
                            </v-col>

                            <v-col
                                class="layout justify-center align-center col-12 col-xs-4 col-md-4 col-lg-4 col-xl-4">
                                <v-text-field class="mt-6"
                                              prepend-inner-icon="mdi-magnify"
                                              v-on:keyup="getFilteredKeywords"
                                              v-model="textKeywordSearch"
                                              placeholder="Recherche par mots clés...">
                                </v-text-field>
                            </v-col>
                            <v-col
                                class="layout justify-center justify-md-end align-center col-12 col-xs-4 col-md-4 col-lg-4 col-xl-4">
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
                            v-for="item in getFilteredKeywords"
                            :key="item.id"
                            @click="goTo(item)"
                            style="max-width: 460px;"
                        >
                            <SharedUsersMdCards
                                v-bind:item="item"
                            />
                        </v-col>
                    </v-row>
                </div>

            </v-row>
        </v-container>
    </div>
</template>

<style>
.item-container {
    width: 100%;
}

.divider {
    margin: 5px;
}

.clear-button {
    margin-top: auto;
}
</style>

<script>
import SharedUsersMdCards from "../component/SharedUsersMdCards";
import AutocompleteCategorie from "../component/AutocompleteCategory";
import Utils from '../../../helpers/utils';
import {apiService} from "../../../services/apiService";
import {EventBus} from "../../../eventBus";
import {MdUtils} from "../MdUtils/Utils";

const utils = new Utils();
const mdUtils = new MdUtils();

export default {
    name: "ListMarkdowns",
    components: {
        SharedUsersMdCards,
        AutocompleteCategorie
    },
    data() {
        return {
            markdown_list: [],
            category: "",
            textKeywordSearch: '',
            textCategorySearch: ''
        };
    },
    mounted() {
        this.getMdCommuns();
    },
    computed: {
        getFilteredKeywords() {
            return this.markdown_list.filter(item => {
                return item.description.toLowerCase().includes(this.textKeywordSearch.toLowerCase());
            })
        },
    },
    methods: {
        async getMdCommuns() {
            try {
                let markdowns = await apiService.get(`${location.origin}/api/markedown/markdowns-commun`)
                console.log(markdowns)
                // this.markdown_list = mdUtils.formatDataMdCom(markdowns.data.data)
                // this.category = '';
            } catch (error) {
                console.log(error)
                EventBus.$emit('snackbar', {
                    snackbar: true,
                    text: error,
                    color: 'red',
                    timeout: 3000
                })
            }
        },
        async getByCategory() {
            if (this.category !== "") {
                try {
                    let markdown = await apiService.get(`${location.origin}/api/markedown/markdown/category/${this.category}`)
                    this.markdown_list = mdUtils.formatDataMdCom(markdown.data.data);
                } catch (e) {
                    console.log(e)
                }
            }
        },
        getMdByCategory: function (id) {
            this.category = id;
            this.getByCategory();
        },
        displayClear() {
            document.getElementsByClassName('clear-button').css('display', 'none');
        },
        clearFilter() {
            this.getMdCommuns();
        },
        goTo(item) {
            this.$router.push({name: 'ShowReadMd', params: {id: item.id.toString()}})
        },
    },
};
</script>
