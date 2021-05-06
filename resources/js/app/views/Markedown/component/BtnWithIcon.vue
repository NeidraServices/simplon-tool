<template>
    <router-link :to="{name: routeName, params: !parameters ? {} : parameters }" custom v-slot="{ navigate }">
        <v-btn 
            class="ma-2" 
            @click="navigate" 
            @keypress.enter="navigate" 
            role="link"
        >
            <slot/>
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
            routeName:{
                type: String
            }, 
            parameters: {
                type: Object
            } 
        }
    }
</script>