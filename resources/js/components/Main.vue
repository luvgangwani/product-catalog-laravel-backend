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

	import { mapGetters } from 'vuex';

	export default {
		data() {
			return {
				
			}
		},

		computed: {
			...mapGetters([
				'user',
				'error'
			])
		},

		components: {
			'app-header': Header,
			'app-footer': Footer
		},

		methods: {
			getUserByUserId: async function() {
				await this.$store.dispatch('getUserByUserId')
			}
		},

		created() {
			if (localStorage.getItem('accessToken') !== "null") {
				this.getUserByUserId();

				if (this.error != null) {
					Vue.$toast.open({
						message: this.error,
						type: 'error'
					});
				}
			}
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