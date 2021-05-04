<template>
	<v-container class="fill-height">
		<v-row class="pa-15" align="center" justify="center">
			<v-card>
				<v-toolbar flat>
					<v-toolbar-title>Connexion</v-toolbar-title>
					<v-spacer />
				</v-toolbar>
				<v-card-text>
					<v-form
						ref="form"
						v-model="valid"
						:lazy-validation="lazy"
						class="pa-15 hidden-sm-and-down"
					>
						<v-text-field
							label="Email de connexion"
							v-model="user.email"
							:rules="emailRules"
							prepend-icon="mdi-account"
							type="text"
						/>

						<v-text-field
							label="Mot de passe"
							v-model="user.password"
							:rules="pwdRules"
							prepend-icon="mdi-lock"
							type="Password"
							@keydown.enter="connection"
						/>
					</v-form>
					<v-form
						ref="form"
						v-model="valid"
						:lazy-validation="lazy"
						class="hidden-md-and-up"
					>
						<v-text-field
							label="Email de connexion"
							v-model="user.email"
							:rules="emailRules"
							prepend-icon="mdi-account"
							type="text"
						/>

						<v-text-field
							label="Mot de passe"
							v-model="user.password"
							:rules="pwdRules"
							prepend-icon="mdi-lock"
							type="Password"
							@keydown.enter="connection"
						/>
					</v-form>
				</v-card-text>
				<v-card-actions>
					<v-row>
						<v-col>
							<v-btn text color="error"
								>Mot de passe oublié?</v-btn
							>
						</v-col>
						<v-col>
							<v-btn text color="success" :disabled="!valid" @click="connection"
								>Se connecter</v-btn
							>
						</v-col>
					</v-row>

					<div class="ml-7">
						<span>{{ erreur }}</span>
					</div>
				</v-card-actions>
			</v-card>
		</v-row>
	</v-container>
</template>

<script src='./login.js'>
</script>