<template>
    <v-col cols="12">
        <v-card>
             <v-row>
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
                        class="layout justify-end"
                    >
                        <div>
                            <v-badge
                                color="green"
                                class="mr-5"
                            >                        
                            </v-badge>
                        </div>
                        Publié
                    </v-card-text>
            </v-row> 
            <v-card-title 
                class="layout justify-center"
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
                <v-col cols="6">
                    <v-card-text 
                        class="layout justify-start"
                    >
                        <v-icon color="primary" class="mr-2">mdi-tag</v-icon>{{item.category}}
                    </v-card-text>
                </v-col>                
                <v-col cols="6"> 
                    <v-card-text 
                        class="layout justify-end"
                    >
                        <v-icon color="primary" class="mr-2">mdi-account</v-icon>{{item.author}}
                    </v-card-text> 
                </v-col>
            </v-row> 
        </v-card>     
    </v-col>
</template>
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
<style>
    .my-card:hover{
        cursor: pointer;
    }
    .contenu{
        text-align: justify;
        overflow:hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical; 
        height: 4.125rem;/*Soit 3 x 1.375rem;*/        
    }
</style>