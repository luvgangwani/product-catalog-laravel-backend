<template>
	<div class="card">
		<div class="card-title">
			{{ pageTitle }}
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				pageTitle: 'Login'
			}
		}
	}
</script>

<style scoped>

	.card {
		color: #102c48;
	}
	
</style>