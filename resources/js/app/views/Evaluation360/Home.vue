<template>
    <v-container fluid>
        <div v-if="this.userRole.id == 2">
            <h2 class="text-center">Statistiques</h2>
            <v-divider class="px-10 my-5"></v-divider>

            <pie-chart
                v-if="isLoaded"
                :chartdata="chartDataSondage"
                :options="chartOptionsSondage"
            ></pie-chart>
        </div>
    </v-container>
</template>

<script src="./home.js"></script>