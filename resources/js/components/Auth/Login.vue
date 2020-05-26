<template>
	<auth-form-template>
		<div slot="form-header">
			{{ pageTitle }}
		</div>
		<div class="form-group" slot="form-fields">
			<label class="required" for="username">Username</label>
			<input type="text" name="username" class="form-control form-control-lg" placeholder="johndoe" v-model="loginInfo.username">
		</div>
		<div class="form-group" slot="form-fields">
			<label class="required" for="passowrd">Passoword</label>
			<input type="password" name="password" class="form-control form-control-lg" v-model="loginInfo.password">
		</div>
		<div class="text-center" slot="form-controls">
			<button type="submit" class="btn btn-primary btn-lg mt-4" v-on:click.prevent="login()" v-if="!isLoading">Login</button>
			<button type="submit" class="btn btn-primary btn-lg mt-4" v-on:click.prevent="login()" v-if="isLoading" disabled="true">Authenticating...</button>
		</div>
	</auth-form-template>
</template>

<script>

	import AuthFormTemplate from '../../templates/AuthFormTemplate';

	import { mapGetters } from 'vuex';

	export default {
		data() {
			return {
				pageTitle: 'Admin Login',
				loginInfo: {
					username: '',
					password: ''
				}
			}
		},

		components: {
			'auth-form-template': AuthFormTemplate
		},

		computed: {
			...mapGetters([
				'isLoading',
				'user',
				'error',
				'successMessage'
			])
		},

		methods: {

			login: async function () {

				await this.$store.dispatch('login', this.loginInfo);
				
				if (this.user && this.error == null) {
					
					Vue.$toast.open({
						message: this.successMessage,
						type: 'success'
					});

					this.$router.push({ path: '/admin' });
				}
				else if (this.error != null) {
					Vue.$toast.open({
						message: this.error,
						type: 'error'
					});
				}
			}

		}

	}
</script>

<style scoped>
	
</style>