<template>
	<v-list nav dense>
		<v-list-item link>
			<v-list-item-title><router-link to="/deliver">Tous les projets</router-link></v-list-item-title>
		</v-list-item>
		<v-list-item link>
			<v-list-item-title> <router-link to="/deliver/mesprojets">Mes projets</router-link></v-list-item-title>
		</v-list-item>
		<v-list-item link>
			<v-list-item-title>Menu 3</v-list-item-title>
		</v-list-item>
	</v-list>
</template>

<script src="./menuDeliver.js" />