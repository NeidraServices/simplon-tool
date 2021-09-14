<template>
    <div>
        <v-card-title class="justify-center">Demande de contribution</v-card-title>
        <v-card-text style="height: 300px;">
            <v-expansion-panels class="mt-4">
                <v-expansion-panel
                    v-for="(item,i) in requestList"
                    :key="i"

                >
                    <v-expansion-panel-header>
                        <div class="align-center" v-show="getUser(item.user_id)">
                            <v-icon left color="primary" class="mr-2">mdi-account</v-icon>
                            <span>{{ username }}</span>
                        </div>
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
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
                                    <v-icon color="success" class="mr-2">mdi-checkbox-marked-circle</v-icon>Accepter
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-card-text>
    </div>
</template>
<script>
import BtnWithIcon from "../component/buttons/BtnWithIcon";
import {apiService} from "../../../services/apiService";
import Utils from "../../../helpers/utils";
const utils = new Utils()

export default {
    name: "Contribution",
    components: {
        BtnWithIcon
    },
    data(){
        return{
            username : ""
        }
    },
    props:[
       'requestList',
        'item'
    ],
    created() {
    console.log(this.requestList)
   console.log('iteeeemmm',this.item)
        },
    methods: {
        validate: function () {
        this.$emit("call", { message: "test" });
        },
        cancel: function () {
        // this.dialog = false
        this.$emit("call", { cancel: true, message: "test" });
        },
        async getUser(id){
          let user = await apiService.get(`${location.origin}/api/markedown/user/${id}`)
            let data = user.data.data
            console.log(data.surname)

            this.username = data.surname + " " + data.name


        },
        async acceptContribution(id){
            console.log("accept ID :", id)
            try{
                let data = await apiService.get(`${location.origin}/api/markedown/contribution/accept/${id}`)
                console.log("Response accept contrib :", data)
                this.$emit('show-success-msg', data.data.message)
                this.validate()
            }catch(error) {
                console.log("Error :", error)
                this.$emit('show-error-msg', error);
                this.validate()
            }
        },
        async declineContribution(id){
            try{
                let data = await apiService.get(`${location.origin}/api/markedown/contribution/decline/${id}`)
                console.log("Response decline contrib :", data)
                this.$emit('show-success-msg', data.data.message);                
                this.validate()
            }catch(error) {
                console.log("Error :", error)
                this.$emit('show-error-msg', error);                
                this.validate()
            }
        }
    }
}
</script>
