<template>

	<div class="row mx-auto">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class="card mt-5 pt-4">
				<div class="card-title text-center">
					<h4><slot name="form-header"></slot></h4>
				</div>
				<div class="card-body">
					<form>
						<slot name="form-fields"></slot>
						<slot name="form-controls"></slot>
					</form>
				</div>		
			</div>
		</div>
		<div class="col-md-4"></div>
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

.card {
	border-radius: 0;
	border: 1px solid #102c4861;
	box-shadow: 0px 4px 5px 0px #102c4861;
}

.card-body {
	color: #102c48;
}

.card-body .btn {
	background-color: #102c48;
	color: #ffffff;
	border-radius: 0;
}
	
</style>