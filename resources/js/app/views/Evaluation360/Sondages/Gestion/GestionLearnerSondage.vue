<template>
	<v-container
		class="d-flex justify-center align-center"
		style="height: 70% !important"
	>
		<v-dialog
			v-model="generalDialog"
			fullscreen
			hide-overlay
			transition="dialog-bottom-transition"
		>
			<v-card class="py-5">
				<v-card-title
					style="background-color: #f1960f; color: white"
					class="d-flex justify-center font-weight-bold py-10"
				>
					{{ title }}
				</v-card-title>

				<v-divider></v-divider>

				<div class="d-flex justify-center mt-8">
					<v-form
						ref="form"
						v-model="valid"
						lazy-validation
						style="width: 85% !important"
					>
						<v-row>
							<v-col>
								<v-text-field
									label="Nom du sondage"
									v-model="sondageName"
									:rules="sondageNameRules"
								/>
							</v-col>
							<v-col>
								<v-select
									v-model="published"
									:rules="publishedRules"
									:items="etatList"
									item-text="label"
									item-value="id"
									persistent-hint
									single-line
									label="Etat - Publié ou Brouillon"
									required
								></v-select>
							</v-col>
						</v-row>

						<v-btn
							text
							outlined
							class="d-flex justify-center align-center mx-auto my-5"
							@click="addLines"
						>
							<div>
								<span>Ajouter une ligne</span>
							</div>
							<div class="ml-4">
								<v-icon color="#F1960F"> mdi-plus-circle-outline </v-icon>
							</div>
						</v-btn>

						<v-row
							no-gutters
							class="justify-center"
							v-for="(line, key) in sondageLines"
							:key="key"
						>
							<v-col cols="3" class="d-flex justify-center">
								<v-select
									v-model="line.type"
									placeholder="Choisir un type de question"
									:items="sondageTypeList"
									item-text="name"
									item-value="id"
									label="Langage"
									persistent-hint
									single-line
									required
									@change="editeChange(line, line.type)"
								>
								</v-select>
							</v-col>

							<v-col cols="7" class="ml-5">
								<v-select
									v-if="showDetailLangage(line.type) || line.type == 0"
									v-model="line.content"
									placeholder="Choisir un langage"
									:items="selectLangages"
									item-text="name"
									item-value="id"
									label="Langage"
									persistent-hint
									single-line
									required
								>
								</v-select>

								<v-select
									v-if="showDetailSkill(line.type) || line.type == 1"
									v-model="line.content"
									placeholder="Choisir une compétence"
									:items="selectSkills"
									item-text="description"
									item-value="id"
									label="Competence"
									persistent-hint
									single-line
									required
								>
								</v-select>

								<v-text-field
									v-if="showDetailQuestion(line.type) || line.type == 2"
									v-model="line.content"
									label="Saisir votre question"
								/>
							</v-col>

							<v-col cols="1" class="d-flex justify-end align-center">
								<div>
									<v-btn icon x-small @click="removeLine(key)">
										<v-icon color="red"> mdi-delete </v-icon>
									</v-btn>
								</div>
							</v-col>
						</v-row>
					</v-form>
				</div>

				<v-card-actions class="pb-10">
					<v-spacer></v-spacer>
					<v-btn
						small
						color="#d14631"
						class="darken-1 mr-3 white--text font-weight-medium"
						@click="closeGeneral"
						>Annuler</v-btn
					>
					<v-btn
						small
						color="#F1960F"
						class="white--text font-weight-medium"
						:disabled="disabled"
						@click="handleSondage"
						>valider</v-btn
					>
					<v-spacer></v-spacer>
				</v-card-actions>
			</v-card>
		</v-dialog>

		<v-dialog v-model="deleteDialog" max-width="600">
			<v-card class="py-5">
				<v-card-title class="d-flex justify-center font-weight-bold">
					Voulez-vous vraiment supprimer ce sondage ?
				</v-card-title>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn
						small
						class="grey darken-1 mr-3 white--text font-weight-medium"
						@click="closeDelete"
						>Annuler</v-btn
					>
					<v-btn
						small
						class="red white--text font-weight-medium"
						@click="deleteSondage"
						>Supprimer</v-btn
					>
					<v-spacer></v-spacer>
				</v-card-actions>
			</v-card>
		</v-dialog>

		<div>
			<div class="d-flex justify-start align-center mb-8">
				<h1 class="text-center">Liste des sondages</h1>
				<v-btn icon class="py-5 ml-5" @click="openGeneral(false)">
					<v-icon color="#F1960F"> mdi-plus-circle-outline </v-icon>
				</v-btn>
			</div>

			<v-card width="900" class="mx-auto">
				<v-card-title>
					<v-text-field
						v-model="search"
						append-icon="mdi-magnify"
						label="Rechercher"
						single-line
						hide-details
					></v-text-field>
				</v-card-title>

				<v-data-table
					:loading="!isLoaded"
					loading-text="Chargement en cours..."
					:headers="headers"
					:items="sondagesList"
					:search="search"
					:page.sync="page"
					@page-count="pageCount = $event"
					hide-default-footer
					class="elevation-1"
					locale="fr"
				>
					<template v-slot:item.actions="{ item }">
						<v-tooltip top>
							<template v-slot:activator="{ on, attrs }">
								<v-btn
									icon
									small
									v-bind="attrs"
									v-on="on"
									class="transparent blue-grey--text mr-2"
									@click="openGeneral(true, item)"
								>
									<v-icon> mdi-square-edit-outline </v-icon>
								</v-btn>
							</template>
							<span>Modifier</span>
						</v-tooltip>

						<v-tooltip top>
							<template v-slot:activator="{ on, attrs }">
								<v-btn
									icon
									small
									class="transparent red--text"
									v-bind="attrs"
									v-on="on"
									@click="openDelete(item)"
								>
									<v-icon> mdi-delete </v-icon>
								</v-btn>
							</template>
							<span>Supprimer</span>
						</v-tooltip>
					</template>
				</v-data-table>
			</v-card>
		</div>
	</v-container>
</template>

<script src="./js/gestionLearnerSondage.js"></script>