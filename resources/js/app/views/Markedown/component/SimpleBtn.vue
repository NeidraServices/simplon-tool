<template>    
    <router-link :to="'/markedowns/'+link" custom v-slot="{ navigate }">
        <v-btn 
            class="ma-2" 
            @click="navigate" 
            @keypress.enter="navigate" 
            role="link"
        >
        {{title}}
    </v-btn>
    </router-link>
</template>
<script>
    export default {        
        props:{
            title:{
                type: String
            },
            link:{
                type: String
            },    
        }
    }
</script>