<template>
	<div class="fondColor">
		<v-row justify="space-between">
			<v-col class="text-center ma-auto" md="4"> <Title /> </v-col>
			<v-col md="4" class="ml-auto ma-auto">
				<v-card elevation="1" class="py-15" max-width="480px">
					<v-toolbar flat>
						<h1 class="px-15">Connexion</h1>

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
								<v-btn to="/reset-password" text color="error">Mot de passe oublié?</v-btn>
							</v-col>
							<v-col class="text-right">
								<v-btn
									text
									color="success"
									:disabled="!valid"
									@click="connection"
									>Se connecter</v-btn
								>
							</v-col>
						</v-row>
					</v-card-actions>
					<div class="ml-7">
						<span>{{ erreur }}</span>
					</div>
				</v-card>
			</v-col>
		</v-row>
	</div>
</template>

<script src='./login.js' />

<style>
.fondColor {
	background-color: #aeb4b7;
	position: absolute;
	height: 100%;
	width: 100%;
	display: flex;
	justify-content: center;
}
</style>
