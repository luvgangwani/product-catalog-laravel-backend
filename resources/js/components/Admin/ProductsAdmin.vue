<template>
	<list-template>
		<div slot="list-header">Products Dashboard</div>
		<!-- Table Column Headers -->
		<th scope="col" slot="list-table-headers">Product Name</th>
		<th scope="col" slot="list-table-headers">Product Price</th>
		<th scope="col" slot="list-table-headers">Edit/Delete</th>

		<!-- Table Body -->
		<tr v-bind:key="index" v-for="({ id, product_name, product_price }, index) in products" slot="list-table-body">
			<td>{{ product_name }}</td>
			<td>{{ product_price }}</td>
			<td>
				<router-link v-bind:to="`/products/${id}`" class="px-2"><img src="../../../images/list-edit.svg"></router-link>
				<router-link v-bind:to="`/products/${id}`" class="px-2"><img src="../../../images/list-delete.svg"></router-link>
			</td>
		</tr>
	</list-template>
</template>

<script>
	
	import { mapGetters } from 'vuex';
	import ListTemplate from '../../templates/ListTemplate';

	export default {

		async created() {

			if(localStorage.getItem('accessToken') === 'null')
				this.$router.push({ path: '/admin/login' })

			await this.$store.dispatch('getAllProducts');
		},

		computed: {
			...mapGetters([
				'products'
			])
		},

		components: {
			'list-template': ListTemplate
		},

		data() {
			return {
				
			}
		}

	}
</script>

<style scoped>
	
</style>