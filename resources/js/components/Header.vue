<template>
	<header class="mb-auto">
		<div class="inner">
			<nav class="navbar navbar-expand-md navbar-dark fixed-top nav-bg">
				<a href="#" class="navbar-brand">E-Tron Product Catalog</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerNavbar" aria-controls="headerNavbar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="headerNavbar">
					<ul class="navbar-nav ml-auto" v-if="logged_in">
						<li class="nav-item"><router-link to="/" class="nav-link" exact>Home</router-link></li>
						<li class="nav-item"><router-link to="/category" class="nav-link" exact>Category</router-link></li>
						<li class="nav-item"><router-link to="/product" class="nav-link" exact>Product</router-link></li>
					</ul>
					<ul class="navbar-nav ml-auto" v-if="!logged_in">
						<li class="nav-item"><router-link to="/login" class="nav-link" exact>Login</router-link></li>
						<li class="nav-item"><router-link to="/register" class="nav-link" exact>Register</router-link></li>
					</ul>
				</div>	
			</nav>
		</div>
	</header>
</template>

<script>
	export default {
		data() {
			return {

				logged_in: false

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