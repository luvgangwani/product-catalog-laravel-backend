<template>
	<div>
		{{ title }}
	</div>
</template>

<script>
	
	export default {

		created() {

			if(localStorage.getItem('accessToken') === 'null')
				this.$router.push({ path: '/admin/login' })
		},

		data() {
			return {
				title: 'Products Dashboard'
			}
		}

	}
</script>

<style scoped>
	
</style>