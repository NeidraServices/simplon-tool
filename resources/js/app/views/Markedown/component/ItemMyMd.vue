<template>
    <v-col cols="12 mb-5">
        <v-card 
            class="my-card layout align-center"
            @click="goTo(item)"
        >         
            <div class="my-badge" 
                @click.stop="showRequets"
                v-if="nbRequest>0"
            >
                <v-row justify="center">
                    <v-dialog
                    v-model="dialog"
                    scrollable
                    max-width="460px"
                    >
                    <template v-slot:activator="{ on, attrs }">
                        <div
                            color="none"
                            v-bind="attrs"
                            v-on="on"
                            class="pa-0 badge-container"
                        >
                         <v-badge
                            color="green"
                            :content="nbRequest"
                            class="mr-5"
                            value='false'
                        >                        
                        </v-badge>
                        </div>               
                    </template>
                    <v-card>
                        <v-card-title class="justify-center">Demande de contribution</v-card-title>
                        <v-card-text style="height: 300px;">
                        <v-expansion-panels class="mt-4">
                            <v-expansion-panel
                                v-for="(item,i) in requestList"
                                :key="i"
                            >
                                <v-expansion-panel-header>
                                    <div class="align-center">
                                        <v-icon left color="primary" class="mr-2">mdi-account</v-icon>{{item.user_id}} Dexter Morgan
                                    </div>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>  
                                    <div class="request-content">                    
                                        {{item.markdown_id}}
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </div>  
                                    <v-row class="mt-2">
                                        <v-col cols="6" class="layout justify-center">
                                            <v-btn
                                                color="error"
                                                text
                                                @click="declineContribution(item.id)"
                                            >
                                                <v-icon color="error" class="mr-2">mdi-close-circle</v-icon>Rejeter
                                            </v-btn>
                                        </v-col>
                                        <v-col cols="6" class="layout justify-center">
                                            <v-btn
                                                color="success"
                                                text
                                                @click="acceptContribution(item.id)"
                                            >
                                                <v-icon color="succes" class="mr-2">mdi-checkbox-marked-circle</v-icon>Accepter
                                            </v-btn>
                                        </v-col>
                                    </v-row>        
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                            </v-expansion-panels>
                        </v-card-text>
                        <!-- <v-divider></v-divider> -->
                        <v-card-actions class="mb-2">         
                            <!-- <v-col cols="6" class="layout justify-center">
                                <v-btn
                                    color="blue darken-1"
                                    text
                                    @click="dialog = false"
                                >
                                    Fermer
                                </v-btn>
                            </v-col>  -->
                        </v-card-actions>
                    </v-card>
                    </v-dialog>
                </v-row>
            </div>
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
            <v-row style="width:100%">
                <v-col class="layout align-center justify-center justify-md-start col-12 col-xs-5 col-md-5 col-lg-5 col-xl-6">
                    <BtnWithIcon v-bind:title="'Archive'" v-bind:routeName="'Archives'" v-bind:parameters="{id:item.id.toString()}">
                        <v-icon
                            left
                            dark
                        >
                            mdi-archive
                        </v-icon>
                    </BtnWithIcon>
                </v-col>
                <!-- <v-spacer></v-spacer> -->
                <v-col class="layout align-center justify-center justify-md-end col-12 col-xs-7 col-md-7 col-lg-7 col-xl-6">
                    <v-switch
                        v-model="modifStatus"
                        @click.stop="updateStatus"
                        :label="`Status: ${status}`"
                        color="success"
                    >
                    </v-switch>
                </v-col>
            </v-row>
        </v-card>   
    </v-col>
</template>
<script>
    import BtnWithIcon from "../component/BtnWithIcon";
    import {APIService} from '../Services/Services'
    const apiCall = new APIService()
    export default {
        components: {
            BtnWithIcon
        },
        data(){
            return{
                status: "En brouillon",
                modifStatus: false,
                nbRequest: 0,
                dialog: false,
                requestList: []
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
                status: {
                    type: Number
                }
            },          
        },
        mounted() {
            this.status = (this.item.status == 0) ? "En brouillon" : "Finalisé"
            this.modifStatus = (this.item.status == 0) ? false : true
            this.getRequests()
        },
        watch: {            
            modifStatus(newValue){
                this.modifStatus = newValue               
            }
        },
        methods: {
            acceptContribution(id){
                console.log("accept ID :", id)
                apiCall.acceptContribution(id).then(
                reponse => {                    
                    console.log("Reponse accept contrib :",reponse)
                    this.$emit('show-success-msg', reponse.data.message);
                }
                ).catch(error=> {
                    console.log("Error :", error)
                    this.$emit('show-error-msg', error);
                })
            },
            declineContribution(id){
                console.log("decline ID :", id)
                apiCall.declineContribution(id).then(
                reponse => {                    
                    console.log("Reponse decline contrib :",reponse)
                    this.$emit('show-success-msg', reponse.data.message);
                }
                ).catch(error=> {
                    console.log("Error :", error)
                    this.$emit('show-error-msg', error);
                })
            },
            getRequests(){
                apiCall.getListContributionRequest(this.item.id).then(
                reponse => {
                    this.nbRequest = reponse.data.length
                    if(reponse.data.length > 0){
                        reponse.data.map(elem=>{
                         this.requestList.push(elem)
                        })
                    }
                    console.log("Rep requestList :",this.requestList)
                }
                ).catch(error=> {
                    console.log("Error :", error)             
                    this.$emit('show-error-msg',error);
                })
            },
            updateStatus(event){
                let dataSend={
                    active:this.modifStatus
                }
                apiCall.updateStatus(dataSend, this.item.id).then(
                     reponse => {
                         console.log("resp :",reponse)
                        if(this.modifStatus) {
                            this.status = "Finalisé"
                        }else {
                            this.status = "En brouillon"
                        }
                        this.$emit('show-success-msg', "Etat modifié avec succès");
                    }
                ).catch(error => {
                    this.modifStatus = !this.modifStatus                
                    this.$emit('show-error-msg',error);
                });
                event.stopPropagation()
            },
            goTo(item){
                this.$router.push({ name: 'ShowEditMd', params: {id: item.id.toString()}})
            },
        }
    }
</script>
<style lang="scss">
    .my-badge{
        position: absolute;
        top: 0;
        left: 0;
        margin-top: 20px;
        margin-left: 30px;
    }
    .badge-container:hover{
        & *{            
            zoom: 1.05;
            margin-top: 5px;
            margin-left:0;
        }
    }
    .contenu,
    .request-content{
        text-align: justify;
        overflow:hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical; 
        height: 4.125rem;/*Soit 3 x 1.375rem;*/        
    }
    .my-card{
        display: flex;
        flex-direction: column;
    }
</style>