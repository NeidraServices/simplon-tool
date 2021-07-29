<template>
    <v-col cols="12 mb-5">
        <v-card v-if="item.status === 1" class="md-commun-card">
            <v-row>
                <v-col cols="6">
                    <v-card-text
                        class="layout justify-start"
                    >
                        <v-icon color="primary" class="mr-2">mdi-tag</v-icon>{{item.category}}
                    </v-card-text>

                </v-col>
                <v-col>
                    <v-card-text v-if="item.status == 0"
                                 class="layout justify-end"
                    >
                        <div>
                            <v-badge
                                color="red"
                                class="mr-5"
                            >
                            </v-badge>
                        </div>
                        En brouillon
                    </v-card-text>
                    <v-card-text v-else
                                 class="layout date"
                    >

                    </v-card-text>
                </v-col>
            </v-row>
            <v-card-title
                class="layout justify-center title-custom"
            >
                {{item.title}}
            </v-card-title>

            <v-card-text
                    class="layout justify-start"
                >
                <div class="contenu">
                        {{item.description}}
                </div>
            </v-card-text>
            <v-row>
                <v-col>
                    <v-card-text
                        class="layout"
                    >
                        <span class="justify-end"> <v-icon color="primary" class="mr-2">mdi-account</v-icon>{{item.author}}</span>
                      <v-spacer></v-spacer>
                        <span class="date">Publié le {{ item.created }}</span>
                    </v-card-text>
                </v-col>

            </v-row>


        </v-card>
    </v-col>
</template>

<style>
.my-card:hover{
    cursor: pointer;
}
.date{
    font-size: 12px !important;
}
.contenu{
    text-align: justify;
    overflow:hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    height: 4.125rem;/*Soit 3 x 1.375rem;*/
}
.title-custom {
    color: #1976d2;
    font-weight: bold !important;
}

</style>

<script>
    export default {

        props:{
            item: {
                title:{
                    type: String
                },
                author:{
                    type: String
                },
                category:{
                    type: String
                },
                description:{
                    type: String
                },
                status:{
                    type: Number
                },
            }
        }
    }
</script>
