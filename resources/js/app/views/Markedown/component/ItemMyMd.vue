<template>
    <v-col cols="12">
        <v-card 
            @click="goTo(item)"
        >               
            <v-row class="pa-5" align="start">
                <v-col cols="3" align="start" justify="center">
                    <div class="my-badge">
                        <v-badge
                            color="green"
                            content="1"
                            class="mr-5"
                            value='false'
                        >                        
                        </v-badge>
                    </div>
                    {{item.title}}
                </v-col>
                <v-col cols="6" align="space-around" justify="space-around">
                    {{item.description}}
                </v-col>
                <v-col cols="3" align="end" justify="center">
                    <v-row>
                        <v-spacer></v-spacer>
                        <div  class="ma-5">
                            <v-switch
                                v-model="modifStatus"
                                @click.stop="updateStatus"
                                :label="`Status: ${status}`"
                                color="success"
                            >
                            </v-switch>
                        </div>
                        <!-- <div class="ma-3">
                            <v-btn
                                icon
                                color="red"
                                @click.stop="goTo2(item)"
                            >
                                <v-icon>mdi-delete

                                </v-icon>
                            </v-btn>
                        </div> -->
                    </v-row>
                </v-col>
            </v-row>
        </v-card>     
    </v-col>
</template>
<script>

    import {APIService} from '../Services/ServiceRecupCateg'
    const apiCall = new APIService()
    export default {
        data(){
            return{
                status: "En brouillon",
                modifStatus: false
            }
        },
        props:{
            item: {
                id: {
                    type: Number
                },
                title:{
                    type: String
                },
                description:{
                    type: String
                },
                active: {
                    type: Number
                }
            },          
        },
        mounted() {
            this.status = (this.item.active == 0) ? "En brouillon" : "Finalisé"
            this.modifStatus = (this.item.active == 0) ? false : true
        },
        watch: {            
            modifStatus(newValue){
                this.modifStatus = newValue               
            }
        },
        methods: {
            updateStatus(event){
                let dataSend={
                    active:this.modifStatus
                }
                apiCall.updateStatus(dataSend, this.item.id).then(
                     reponse => {
                        if(this.modifStatus) {
                            this.status = "Finalisé"
                        }else {
                            this.status = "En brouillon"
                        }
                        this.$emit('show-success-msg', "Mise à jour du status effectué avec succès");
                    }
                ).catch(error => {
                    this.modifStatus = !this.modifStatus                
                    this.$emit('show-error-msg',error);
                });
                event.stopPropagation()
            },
            goTo(item){
                this.$router.push({ name: 'ShowEditMd', params: {id: item.id.toString()}})
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