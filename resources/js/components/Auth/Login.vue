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
			<button type="submit" class="btn btn-primary btn-lg mt-4" v-on:click.prevent="login(loginInfo)">Login</button>
		</div>
	</auth-form-template>
</template>

<script>

	import AuthFormTemplate from '../../templates/AuthFormTemplate';

	import { mapActions } from 'vuex';

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

		methods: {

			...mapActions([
				'login'
			])

		}

	}
</script>

<style scoped>
	
</style>