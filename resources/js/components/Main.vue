<template>
	<div class="container-fluid remove-container-padding">

		<app-header></app-header>
		<router-view></router-view>
		<!-- <app-footer></app-footer> -->
		
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

<style>

.required::after {
	content: '*';
}

.remove-container-padding {
	padding: 0;
}
	
</style>