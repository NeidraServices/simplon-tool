<template>
    <div>
        <v-card-title class="justify-center">Liste des contributeurs</v-card-title>
        <v-card-text style="height: 300px;">
            <v-expansion-panels class="mt-4">
                <v-expansion-panel
                    v-for="(item,i) in listContributeur"
                    :key="i"

                >
                        <div class="align-center mt-4 mb-4 ml-4" v-show="getUser(item.user_id)">
                            <v-icon left color="primary" class="mr-2">mdi-account</v-icon>
                            <span>{{ username }}</span>
                        </div>
                  
                </v-expansion-panel>
            </v-expansion-panels>
            <div class="text-center" style="height: 100%"  v-if="!hasContributor">Aucun contributeur</div>
        </v-card-text>
    </div>
</template>
<script>
import BtnWithIcon from "../component/buttons/BtnWithIcon";
import {apiService} from "../../../services/apiService";
import Utils from "../../../helpers/utils";
const utils = new Utils()

export default {
    name: "ListContributeurs",
    components: {
        BtnWithIcon
    },
    data(){
        return{
            username : "",
            hasContributor: false
        }
    },
    props:[
       'listContributeur',
        'item'
        
    ],
    created() {
        if(this.listContributeur.length > 0) {
            
    console.log("testttt")
            this.hasContributor = true
        }
    console.log('uuuuuuuuuuuu',this.listContributeur)
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
