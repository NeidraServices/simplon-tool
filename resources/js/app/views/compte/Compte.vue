<template>
	<v-container v-if="user" class="container_compte">
		<v-row class="mt-5">
			<h1 class="mb-10">
				{{ user.role.name }} {{ user.name }} {{ user.surname }}
			</h1>
			<v-spacer></v-spacer>

			<div class="updateAvatar">
				<label for="files">
					<div v-if="!avatar" class="img">
						<v-img :src="getAvatar(user.avatar)"></v-img>
					</div>

					<div v-if="avatar" class="img">
						<v-img :src="avatar"></v-img>
					</div>

					<h5 class="text-center font-weight-thin mt-5">Modifier la photo</h5>
				</label>
				<input
					id="files"
					ref="file"
					style="display: none"
					type="file"
					@change="onFileChange"
				/>
			</div>
		</v-row>

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
				<v-btn icon v-if="isUpdateSurname" text @click="updateUser(), (isUpdateSurname = false)"
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
				<v-btn icon v-if="isUpdateEmail" text @click="updateUser(), (isUpdateEmail = false)"
					><v-icon>mdi-pencil-plus</v-icon></v-btn
				>
			</v-list-item>
			<v-card-actions>
				<PasswordChange />
			</v-card-actions>
		</v-card>

		<AppLink />
	</v-container>
	
</template>

<script src="./compte.js"></script>
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

.updateAvatar {
	position: relative;
	border-radius: 50%;
	overflow: hidden;

	.img {

		.v-image {
			width: 100%;
			height: 100%;
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
			top: 0;
		}
	}

	label {
		h5 {
			cursor: pointer;
		}
	}
	.fileChange {
		margin: 5px auto;
	}
}
</style>