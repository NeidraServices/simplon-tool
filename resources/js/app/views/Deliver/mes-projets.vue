<template>

<div class="ml-5">
    <h2 class="ml-7 mb-3">Mes projets</h2>
    <div class="d-flex flex-wrap justify-space-around">
        <div v-for="projet in projets" :key="projet.id" >
            <ProjetTemplate :user="user" :projet="projet" />
        </div>
    </div>
</div>

</template>

<script src="./js/mes-projets.js"></script>