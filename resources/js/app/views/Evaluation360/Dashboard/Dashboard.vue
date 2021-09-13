<template>
	<div>
		<v-menu :close-on-content-click="false">
			<template v-slot:activator="{ on, attrs }">
				<v-btn class="filter" rounded v-bind="attrs" v-on="on"
					><v-icon>mdi-filter-variant</v-icon></v-btn
				>
			</template>
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
						label="Nom de l'apprenants"
					></v-autocomplete>
				</v-list-item>
				<v-list-item>
					<v-select
						v-model="note"
						:items="['bas', 'moyen', 'haute']"
						label="Notes"
					></v-select>
				</v-list-item>
				<v-list-item>
					<v-btn rounded text @click="filter()" style="color: #d14631"
						>Filtrer</v-btn
					>
					<v-btn rounded text @click="allApprenant()">Tout voir</v-btn>
				</v-list-item>
			</v-list>
		</v-menu>

		<ApprenantsCards />
	</div>
</template>
<script src='./dashboard.js' />

<style lang="scss">
.filter {
	position: fixed !important;
	right: 0 !important;
	bottom: 0 !important;
	margin-bottom: 5vh !important;
	margin-right: 3vw !important;
}
</style>