<template>
	<v-app-bar
		v-if="isChecked"
		id="app-bar"
		absolute
		app
		color="transparent"
		flat
		height="75"
	>
		<v-spacer />
		<v-dialog v-model="dialog" width="550">
			<template v-slot:activator="{ on, attrs }">
				<v-btn icon color="error" dark v-bind="attrs" v-on="on">
					<v-icon color="error">mdi-logout</v-icon>
				</v-btn>
			</template>

			<v-card>
				<v-card-title class="headline grey lighten-2">
					Êtes vous sûr de vouloir vous deconnecter ?
				</v-card-title>

				<v-divider></v-divider>

				<v-card-actions>
					<v-btn color="error" text @click="dialog = false">
						<v-icon>mdi-close</v-icon></v-btn
					>
					<v-spacer></v-spacer>
					<v-btn color="success" text @click="logout()">
						<v-icon>mdi-check</v-icon></v-btn
					>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</v-app-bar>
</template>

<script>
import { authenticationService } from "../services/authenticationService";
export default {
	data() {
		return {
			role: null,
			dialog: false,
		};
	},
	computed: {
		isChecked() {
			let routeName = this.$route.path;
			var splits = routeName.split("/", 2);
			if (splits[1] != "compte") {
				return this.$store.state.isLogged;
			}
		},
	},
	created() {
		authenticationService.role.subscribe((x) => (this.role = x));
	},
	methods: {
		async logout() {
			this.dialog = false;
			await localStorage.removeItem("vuex");
			await localStorage.removeItem("token");
			await localStorage.removeItem("role");
			await this.$store.commit("disconnect");
			await this.$router.push('/connexion');
		},
	},
};
</script>