<template>
	<v-card-title class="text-align-center d-flex flex-column">
		<h1 class="size py-0 mb-10 font-weight-thin">SIMPLONAPP</h1>
		<v-img
			:src="getLogos('logo.png')"
			max-height="300px"
			max-width="300px"
		></v-img>
		<p class="mt-10">La plateforme collaborative d'apprentissage en pédagogie active</p>
	</v-card-title>
</template>

<script>
export default {
	methods: {
		getLogos(image) {
			return `${location.origin}/images/logo/${image}`;
		},
	},
};
</script>
<style >
.size {
	font-size: 5rem;
	text-align: center;
  color: white;
}
</style>
