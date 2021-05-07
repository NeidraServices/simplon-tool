<template>
	<v-row justify="space-around">
		<v-col
			class="my-auto"
			v-for="(app, key) in apps"
			:key="key"
			cols="12"
			md="4"
		>
			<v-sheet
				@click="pushLink(app.link)"
				class="pa-12 btn_compte"
				elevation="3"
			>
				<h1 class="text-center">{{ app.name }}</h1>
				<v-card-actions class="d-flex justify-center pb-5">
					<v-btn class="acceder" depressed> Accéder </v-btn>
				</v-card-actions>
			</v-sheet>
		</v-col>
	</v-row>
</template>

<script src="./appLink.js" />