<template>
	<v-dialog v-model="dialog" width="500">
		<template v-slot:activator="{ on, attrs }">
			<v-btn depressed class="mx-auto" v-bind="attrs" v-on="on"
				><v-icon>mdi-lock-reset</v-icon> Changer votre mot de passe
			</v-btn>
		</template>

		<v-card class="pa-10">
			<v-card-title>
				<h4 class="mx-auto">Changement de mot de passe</h4>
			</v-card-title>
			<v-divider class="my-5"></v-divider>

			<v-form v-model="valid">
				<v-text-field
					type="password"
					required
					:rules="[
						(v) => !!v || 'mot de passe requis',
						(v) => v.length >= 6 || '6 caractère minimum',
					]"
					v-model="password"
					label="mot de passe"
				></v-text-field>
				<v-text-field
					type="password"
					required
					:rules="[
						(v) => !!v || 'confirmation requis',
						(v) => v == password || 'ne correspond pas au précédent',
					]"
					v-model="password_confirmation"
					label="confirmer le mot de passe"
				></v-text-field>
			</v-form>
			<v-card-actions class="mt-5">
				<v-btn depressed @click="resetForm()"> Annuler </v-btn>
				<v-spacer></v-spacer>
				<v-btn depressed @click="updatePassword()" :disabled="!valid">
					Valider
				</v-btn>
			</v-card-actions>
		</v-card>
	</v-dialog>
</template>

<script src="./passwordChange.js" />