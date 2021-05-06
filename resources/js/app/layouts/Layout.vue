<template>
	<v-app>
		<Sidebar v-if='isChecked'>
			<template v-slot:menus>
				<MenuEval v-if='pathIsEval'/>
				<MenuMd v-if='pathIsMd'/>
				<MenuDeliver v-if='pathIsDeliver'/>
			</template>
			<template v-slot:lien>
				<v-row class="py-4">
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
			<Logout />
		<v-main>
			<router-view></router-view>
		</v-main>
	</v-app>
</template>

<script src="./layout.js"></script>