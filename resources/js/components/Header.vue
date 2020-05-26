<template>
	<nav class="navbar navbar-expand-md navbar-dark nav-bg">
		<a href="/admin" class="navbar-brand">E-Tron Product Catalog</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerNavbar" aria-controls="headerNavbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="headerNavbar">
			<ul class="navbar-nav ml-auto" v-if="user">
				<li class="nav-item"><router-link to="/admin" class="nav-link" exact>Home</router-link></li>
				<li class="nav-item"><router-link to="/admin/category" class="nav-link" exact>Category</router-link></li>
				<li class="nav-item"><router-link to="/admin/product" class="nav-link" exact>Product</router-link></li>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi {{ user.first_name }}</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" to="#" v-on:click.prevent="logout()">Logout</a>
					</div>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto" v-if="!user">
				<li class="nav-item"><router-link to="/admin" class="nav-link" exact>Home</router-link></li>
				<li class="nav-item"><router-link to="/admin/login" class="nav-link" exact>Login</router-link></li>
			</ul>
		</div>	
	</nav>
</template>

<script>
	import { mapGetters } from 'vuex';

	export default {
		data() {
			return {

			}
		},

		computed: {

			...mapGetters([
				'user'
			])

		},

		methods: {
			logout: async function() {
				await this.$store.dispatch('logout');

				this.$router.push({ path: '/admin/login' });
			}
		}
	}
</script>

<style scoped>

.nav-bg {
	background-color: #102c48e0;
}

a {
	color: #ffffff;
}

.router-link-active {
	background-color: #ffffff;
	color: #102c48e0 !important;
	border-radius: 7px;
}
</style>