<template>
	<div>
		<v-list class="px-5">
			<v-list-item>
				<v-list-item-title> Filtre </v-list-item-title>
			</v-list-item>
			<v-list-item>
				<v-autocomplete
					v-model="apprenant"
					:items="apprenants"
					item-text="name"
					item-value="name"
					label="Nom de l'apprenant"
				></v-autocomplete>
			</v-list-item>
			<v-list-item>
				<v-btn rounded text @click="filter()">Filtrer</v-btn>
			</v-list-item>
		</v-list>
		<ApprenantsCards />
	</div>
</template>
<script src='./dashboard.js' />