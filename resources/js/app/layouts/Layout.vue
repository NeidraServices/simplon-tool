<template>
	<v-app>
		<Sidebar>
			<template v-slot:menus>
				<v-list nav dense>
					<v-list-item link>
						<v-list-item-title>Menu 1</v-list-item-title>
					</v-list-item>
					<v-list-item link>
						<v-list-item-title>Menu 2</v-list-item-title>
					</v-list-item>
					<v-list-item link>
						<v-list-item-title>Menu 3</v-list-item-title>
					</v-list-item>
				</v-list>
			</template>
			<template v-slot:lien>
				<v-row>
					<v-col
						class="link text-center"
						cols="12"
						md="6"
						sm="6"
						@click="prev()"
					>
						<span>{{ prevName }}</span>
					</v-col>

					<v-col
						class="link text-center"
						cols="12"
						md="6"
						sm="6"
						@click="next()"
					>
						<span> {{ nextName }} </span>
					</v-col>
				</v-row>
			</template>
		</Sidebar>
		<v-main>
			<router-view></router-view>
		</v-main>
	</v-app>
</template>

<script src="./layout.js"></script>