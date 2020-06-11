<template>
	<div>
		{{ title }}
	</div>
</template>

<script>

	export default {

		created() {
			const accessToken = localStorage.getItem('accessToken');

			if( accessToken == null || typeof accessToken == 'undefined')
				this.$router.push({ path: '/admin/login' })
		},

		data() {
			return {
				title: 'Users Dashboard'
			}
		},

	}
</script>

<style scoped>
	
</style>