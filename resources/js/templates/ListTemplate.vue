<template>
	<div>
		<div class="h3 mt-5"><slot name="list-header"></slot></div>
		<div class="h5 mt-5" v-if="isLoading">Loading...</div>
		<slot name="list-template-add" v-if="!isLoading"></slot>
		<table class="table" v-if="!isLoading">
			<thead class="thead-dark">
				<tr>
					<slot name="list-table-headers"></slot>
				</tr>
			</thead>
			<tbody>
				<slot name="list-table-body"></slot>
			</tbody>
		</table>
		<slot name="modal"></slot>
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
				'isLoading'
			])
		},
	}
</script>

<style scoped>

.table .thead-dark th {
	background-color: #102c48;
	border-color: #102c48;;
}
	
</style>