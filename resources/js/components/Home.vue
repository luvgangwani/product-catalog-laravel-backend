<template>
	<div class="cover-background">

		<div class="h1 text-center py-5 strong">
			Administrator Console
		</div>

		<div class="row mx-auto">
			<div class="col-md-3"></div>
			<div class="col-md-3 col-sm-12 py-2">
				<router-link to="/admin/products">
					<div class="card">
						<img class="card-img-top" src="../../images/home-page-products.svg" />
						<div class="card-body h5 text-center">
							Add/Edit/Remove Products
						</div>
					</div>
				</router-link>
			</div>
			<div class="col-md-3 col-sm-12 py-2">
				<router-link to="/admin/categories">
					<div class="card">
						<img src="../../images/home-page-categories.svg" class="card-img-top">
						<div class="card-body h5 text-center">
							Add/Edit/Remove Categories
						</div>
					</div>
				</router-link>
			</div>
			<div class="col-md-3"></div>	
		</div>
		<div class="row mx-auto">
			<div class="col-md-3"></div>
			<div class="col-md-3 col-sm-12 py-2">
				<router-link to="/admin/users">
					<div class="card">
						<img src="../../images/home-page-users.svg" class="card-img-top">
						<div class="card-body h5 text-center">
							Add/Edit/Remove Users
						</div>
				</div>
				</router-link>
			</div>
			<div class="col-md-3 col-sm-12 py-2">
				<router-link to="/admin/users">
					<div class="card">
						<img src="../../images/home-page-approve.svg" class="card-img-top">
						<div class="card-body h5 text-center">
							Approve Users as Admins
						</div>
					</div>
				</router-link>
			</div>
			<div class="col-md-3"></div>
		</div>

	</div>
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
		}
	}
</script>

<style scoped>

	.strong {
		font-weight: bold;
	}

	.card {
		background: #ffffff;
		color: #102c48;
		border-radius: 0;
	}

	.cover-background {
		color: #ffffff;
		min-height: 100%;
		background: #102c48;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}

	a {
		text-decoration: none;
	}

</style>