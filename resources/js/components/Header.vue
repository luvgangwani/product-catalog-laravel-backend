<template>
	<nav class="navbar navbar-expand-md navbar-dark nav-bg">
		<a class="navbar-brand" v-on:click.prevent="goHome()">E-Tron Product Catalog</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerNavbar" aria-controls="headerNavbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="headerNavbar">
			<ul class="navbar-nav ml-auto mr-5" v-if="user">
				<li class="nav-item"><router-link to="/admin" class="nav-link" exact>Home</router-link></li>
				<li class="nav-item"><router-link to="/admin/categories" class="nav-link" exact>Categories</router-link></li>
				<li class="nav-item"><router-link to="/admin/products" class="nav-link" exact>Products</router-link></li>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi {{ user.first_name }}</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#" v-on:click="logout()">Logout</a>
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
				'user',
			])

		},

		methods: {

			goHome: function() {
				this.$router.push({ path: '/admin'})
			},

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

.nav-link {
	color: #ffffff !important;
}

.navbar-brand {
	cursor: pointer;
}

.nav-link:hover {
	background-color: #102c48e0 !important;
	border-radius: 7px;
	color: #ffffff !important;
}

.router-link-active {
	background-color: #ffffff;
	color: #102c48e0 !important;
	border-radius: 7px;
}

.dropdown-menu {
	background-color: #2c445e;
	border: 1px solid #ffffff;
}

.dropdown-menu .dropdown-item {
	background-color: #2c445e;
	color: #ffffff !important;
}

</style>