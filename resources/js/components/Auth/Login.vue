<template>
	<auth-form-template>
		<div slot="form-header">
			{{ pageTitle }}
		</div>
		<div class="form-group" slot="form-fields">
			<label for="username">Username:</label>
			<input type="text" name="username" class="form-control form-control-lg" placeholder="johndoe">
		</div>
		<div class="form-group" slot="form-fields">
			<label for="passowrd">Passoword:</label>
			<input type="password" name="password" class="form-control form-control-lg">
		</div>
		<div class="text-center" slot="form-controls">
			<div class="btn btn-primary btn-lg mt-4">Login</div>
		</div>
	</auth-form-template>
</template>

<script>

	import AuthFormTemplate from '../../templates/AuthFormTemplate';

	export default {
		data() {
			return {
				pageTitle: 'Admin Login'
			}
		},

		components: {
			'auth-form-template': AuthFormTemplate
		}
	}
</script>

<style scoped>
	
</style>