<template>
<div>
    <v-container>
        <v-spacer></v-spacer>
        <v-row>
            <h2>Mes markdowns</h2>
            <v-spacer></v-spacer>
            <router-link to="/markedowns/add" custom v-slot="{ navigate }">
                <v-btn @click="navigate" @keypress.enter="navigate" role="link">Ajouter</v-btn>
            </router-link>
        </v-row>
    </v-container>
</div>
</template>
<script>
import MdEditor from "./component/MdEditor";
export default {
    name: "MyMarkedDowns",
    components: {
        MdEditor
    },
    data() {
        return {
        };
    },
};
</script>
