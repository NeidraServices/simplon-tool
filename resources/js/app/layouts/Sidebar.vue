<template>
	<div>
		<v-container fluid v-if='isChecked'>
			<v-navigation-drawer mobile-breakpoint="960" app width="260">
				<v-list class="d-flex listSidebar">
					<v-list-item>
						<v-list-item-avatar>
							<v-img
								src="https://randomuser.me/api/portraits/women/85.jpg"
							></v-img>
						</v-list-item-avatar>
					</v-list-item>

					<v-list-item link>
						<v-list-item-content>
							<v-list-item-title class="title">
								Sandra Adams
							</v-list-item-title>
							<v-list-item-subtitle>sandra_a88@gmail.com</v-list-item-subtitle>
						</v-list-item-content>
					</v-list-item>
				</v-list>

				<v-divider></v-divider>

				<slot name="menus"></slot>
				<template v-slot:append>
					<slot name="lien"></slot>
				</template>
			</v-navigation-drawer>
		</v-container>
	</div>
</template>

<script>
import { authenticationService } from "../services/authenticationService";

export default {
	data() {
		return {
			role: null,
		};
	},
	computed: {
		isChecked() {
			return this.$store.state.isLogged;
		},
	},

	created() {
		authenticationService.role.subscribe((x) => (this.role = x));
	},
};
</script>

<style>
.link:hover {
	background-color: gray;
	color: white;
	cursor: pointer;
}

.link:nth-child(1) {
	border: 1px solid rgba(0, 0, 0, 0.12);
	border-bottom: 0;
}

.link:nth-child(2) {
	border-top: 1px solid rgba(0, 0, 0, 0.12);
}

.listSidebar {
	display: flex;
	flex-direction: column;
	align-items: center;
	text-align: center;
}
</style>