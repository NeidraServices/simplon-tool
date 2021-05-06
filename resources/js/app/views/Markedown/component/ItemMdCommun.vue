<template>
    <v-col cols="12">
        <v-card>
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
            }            
        }
    }
</script>
<style>
    .contenu{
        white-space: nowrap ;
        word-break: normal;
        overflow: hidden ;
        text-overflow: ellipsis;
    }
</style>