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

export default {
    name: "Contribution",
    components: {
        BtnWithIcon
    },
    data(){
        return{ }
    },
    props:[
       'requestList',
        { item : {}}
    ],
    methods: {
        async acceptContribution(id){
            console.log("accept ID :", id)
            try{
                let data = await apiService.get(`${location.origin}/api/markedown/contribution/accept/${id}`)
                console.log("Response accept contrib :", data)
                this.$emit('show-success-msg', data.data.message)
            }catch(error) {
                console.log("Error :", error)
                this.$emit('show-error-msg', error);
            }
        },
        async declineContribution(id){
            try{
                let data = await apiService.get(`${location.origin}/api/markedown/contribution/decline/${id}`)
                console.log("Response decline contrib :", data)
                this.$emit('show-success-msg', data.data.message);
            }catch(error) {
                console.log("Error :", error)
                this.$emit('show-error-msg', error);
            }
        }
    }
}
</script>
