<template>
	<v-list nav dense>
		<v-list-item v-if="!isApprenant" link to="/deliver">
			<v-list-item-title>Tous les projets</v-list-item-title>
		</v-list-item>
	
		<v-list-item v-if="isApprenant " link to="/deliver/mesprojets">
			<v-list-item-title>Mes projets</v-list-item-title>
		</v-list-item>
	
		<v-list-item v-if="!isApprenant" link to="/deliver/formateur">
			<v-list-item-title>Formateur</v-list-item-title>
		</v-list-item>
	</v-list>
</template>

<script src="./menuDeliver.js" />