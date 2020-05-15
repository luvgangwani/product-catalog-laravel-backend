<template>
	<div class="container">

		<app-header></app-header>
		<router-view></router-view>
		<app-footer></app-footer>
		
	</div>
</template>

<script>

	import Header from './Header';
	import Footer from './Footer';

	export default {
		data() {
			return {
				
			}
		},

		components: {
			'app-header': Header,
			'app-footer': Footer
		}
	}
</script>

<style scoped>
	
</style>