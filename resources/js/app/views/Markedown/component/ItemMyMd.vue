<template>
    <v-col cols="12">
        <v-card>               
            <v-row class="pa-5">
                <v-col>
                    <div class="my-badge">
                        <v-badge
                            color="green"
                            content="6"
                            class="mr-5"
                            value='false'
                        >                        
                        </v-badge>
                    </div>
                    {{item.title}}
                </v-col>
                <v-col>Test</v-col>
                <v-col>Test</v-col>
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
                }
            }            
        }
    }
</script>
<style lang="scss">
    .my-badge{
        position: absolute;
        top: 0;
        left: 10;
        margin-top: 5px;
    }
</style>