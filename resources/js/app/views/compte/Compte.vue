<template>
	<v-container v-if="user" class="container_compte">
		<h1 class="mb-10">
			{{ user.role.name }} {{ user.name }} {{ user.surname }}
		</h1>
		<v-card class="mx-auto my-10 pa-10" max-width="400" tile>
			<v-list-item>
				<v-list-item-content>
					<v-list-item-title><h2>Informations</h2></v-list-item-title>
				</v-list-item-content>
			</v-list-item>
			<v-list-item>
				<v-list-item-title v-if="!isUpdateName"
					>Nom : {{ user.name }}</v-list-item-title
				>
				<v-text-field
					v-if="isUpdateName"
					v-model="userInfos.name"
					label="nom"
				></v-text-field>
				<v-btn icon v-if="!isUpdateName" text @click="isUpdateName = true"
					><v-icon>mdi-pencil-box-outline</v-icon></v-btn
				>
				<v-btn
					icon
					v-if="isUpdateName"
					text
					@click="updateUser(), (isUpdateName = false)"
					><v-icon>mdi-pencil-plus</v-icon></v-btn
				>
			</v-list-item>
			<v-divider></v-divider>
			<v-list-item two-line>
				<v-list-item-title v-if="!isUpdateSurname"
					>Surnom : {{ user.surname }}</v-list-item-title
				>
				<v-text-field
					v-if="isUpdateSurname"
					v-model="userInfos.surname"
					label="prenom"
				></v-text-field>
				<v-btn icon v-if="!isUpdateSurname" text @click="isUpdateSurname = true"
					><v-icon>mdi-pencil-box-outline</v-icon></v-btn
				>
				<v-btn icon v-if="isUpdateSurname" text @click="isUpdateSurname = false"
					><v-icon>mdi-pencil-plus</v-icon></v-btn
				>
			</v-list-item>
			<v-divider></v-divider>

			<v-list-item three-line>
				<v-list-item-title v-if="!isUpdateEmail"
					>Email : {{ user.email }}</v-list-item-title
				>
				<v-text-field
					v-model="userInfos.email"
					type="email"
					v-if="isUpdateEmail"
					label="Email"
				></v-text-field>
				<v-btn icon v-if="!isUpdateEmail" text @click="isUpdateEmail = true"
					><v-icon>mdi-pencil-box-outline</v-icon></v-btn
				>
				<v-btn icon v-if="isUpdateEmail" text @click="isUpdateEmail = false"
					><v-icon>mdi-pencil-plus</v-icon></v-btn
				>
			</v-list-item>
			<v-card-actions>
				<PasswordChange />
			</v-card-actions>
		</v-card>

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
	</v-container>
</template>

<script src="./compte.js" />

<style lang="scss">
.container_compte {
	height: 100%;
	display: flex;
	flex-direction: column;
}

.btn_compte {
	cursor: pointer;
	animation: all 0.3s ease;

	.acceder {
		animation: all 0.3s ease;
	}
}

.btn_compte:hover {
	background-color: #aeb4b7 !important;
	color: white !important;
	transition: all 0.3s ease;

	.acceder {
		background-color: gray !important;
		color: white !important;
		transition: all 0.3s ease;
	}
}
</style>