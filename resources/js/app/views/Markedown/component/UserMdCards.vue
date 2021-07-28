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
                        <Contributions v-bind:requestList="requestList" v-bind:item="item"/>
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
<script>
    import BtnWithIcon from "./buttons/BtnWithIcon";
    import {APIService} from '../Services/Services'
    import {apiService} from "../../../services/apiService";
    import Contributions from "../markedown/Contributions";

    export default {
        components: {
            Contributions,
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
            this.status = (this.item.status === 0) ? "En brouillon" : "Finalisé"
            this.modifStatus = (this.item.status !== 0)
            this.getRequests()
        },
        watch: {
            modifStatus(newValue){
                this.modifStatus = newValue
            }
        },
        methods: {
            async getRequests(){
               try{
                   let data = await apiService.get(`${location.origin}/api/markedown/request/${this.item.id}`)
                   this.nbRequest = data.data.length
                   if(data.data.length > 0){
                       data.data.map(elem => {
                           this.requestList.push(elem)
                       })
                   }
                   console.log("Rep requestList :",this.requestList)

               }catch(error) {
                    console.log("Error :", error)
                    this.$emit('show-error-msg',error);
                }
            },
            updateStatus(event){
                let dataSend = {
                    active:this.modifStatus
                }

                apiService.post(`${location.origin}/api/markedown/markdown/active/${this.item.id}`, dataSend).then(
                     response => {
                         console.log("resp :", response)
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

