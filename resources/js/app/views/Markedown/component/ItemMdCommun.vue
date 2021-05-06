<template>
    <v-col cols="12">
        <v-card>
             <v-row>
                <v-col cols="4">
                    <v-card-text 
                        class="layout justify-start"
                    >
                    </v-card-text>
                </v-col>                
                <v-col cols="4">
                    <v-card-title 
                        class="layout justify-center"
                    >
                        {{item.title}}
                    </v-card-title>
                </v-col>                
                <v-col cols="4"> 
                    <v-card-text v-if="item.active == 0"
                        class="layout justify-end"
                    >
                    <div>
                        <v-badge
                            color="red"
                            class="mr-5"
                            value='false'
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
                            value='false'
                        >                        
                        </v-badge>
                    </div>
                        Publié
                    </v-card-text> 
                </v-col>
            </v-row> 
            
            <v-card-text 
                class="layout justify-start"
            >
                {{item.description}}
            </v-card-text>  
            <v-row>
                <v-col cols="6">
                    <v-card-text 
                        class="layout justify-start"
                    >
                        {{item.category}}
                    </v-card-text>
                </v-col>                
                <v-col cols="6"> 
                    <v-card-text 
                        class="layout justify-end"
                    >
                        {{item.author}}
                    </v-card-text> 
                </v-col>
            </v-row> 
        </v-card>     
    </v-col>
</template>
<script>
    export default {
        data(){
            return{
                /*  */
            }
        },

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
                active:{
                    type: Number
                },
            }            
        }
    }
</script>