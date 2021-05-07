<template>
    <v-col cols="12">
        <v-card 
            class="my-card layout align-center"
            @click="goTo(item)"
        >         
            <div class="my-badge">
                <v-badge
                    color="green"
                    content="1"
                    class="mr-5"
                    value='false'
                >                        
                </v-badge>
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
                status: {
                    type: Number
                }
            },          
        },
        mounted() {
            this.status = (this.item.status == 0) ? "En brouillon" : "Finalisé"
            this.modifStatus = (this.item.status == 0) ? false : true
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
        margin-top: 5px;
        width: 100%;
        margin-left: 20px;
    }
    .contenu{
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