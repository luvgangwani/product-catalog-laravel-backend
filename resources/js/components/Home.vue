<template>
	<div class="cover-background">

		<div class="h1 text-center py-5 strong">
			Administrator Console
		</div>
		<p class="h5 text-center">Admins can use this console to:</p>

		<div class="row mt-5 mx-auto">
			<div class="col-md-2"></div>
			<div class="col-md-4 col-sm-12 py-2">
				<div class="card">
					<img class="card-img-top" src="../../images/home-page-products.svg" />
					<div class="card-body h5 text-center">
						Add/Edit/Remove Products
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-12 py-2">
				<div class="card">
					<img src="../../images/home-page-categories.svg" class="card-img-top">
					<div class="card-body h5 text-center">
						Add/Edit/Remove Categories
					</div>
				</div>
			</div>
			<div class="col-md-2"></div>	
		</div>
		<div class="row mx-auto">
			<div class="col-md-2"></div>
			<div class="col-md-4 col-sm-12 py-2">
				<div class="card">
					<img src="../../images/home-page-users.svg" class="card-img-top">
					<div class="card-body h5 text-center">
						Add/Edit/Remove Users
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-12 py-2">
				<div class="card">
					<img src="../../images/home-page-approve.svg" class="card-img-top">
					<div class="card-body h5 text-center">
						Approve Users as Admins
					</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>

	</div>
</template>

<script>

	export default {
		data() {
			return {

			}
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
		min-height: 100%;
		background: #102c48;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}

</style>