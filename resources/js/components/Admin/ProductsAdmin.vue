<template>
	<list-template>
		<div slot="list-header">Products Dashboard</div>
		<!-- Add Icon -->
		<router-link to="#" class="float-right p-2" slot="list-template-add" v-on:click.native="openAddProductModal()">
			<img src="../../../images/list-template-home-plus-icon.svg" class="img-fluid" alt="Add product">
		</router-link>
		<!-- Table Column Headers -->
		<th scope="col" slot="list-table-headers">Product Name</th>
		<th scope="col" slot="list-table-headers">Product Price</th>
		<th scope="col" slot="list-table-headers">Edit/Delete</th>

		<!-- Table Body -->
		<tr v-bind:key="index" v-for="({ id, product_name, product_price }, index) in products" slot="list-table-body">
			<td>{{ product_name }}</td>
			<td>${{ product_price }}</td>
			<td>
				<router-link v-bind:to="`/products/${id}`" class="px-2"><img src="../../../images/list-edit.svg"></router-link>
				<router-link v-bind:to="`/products/${id}`" class="px-2"><img src="../../../images/list-delete.svg"></router-link>
			</td>
		</tr>
		<add-product slot="modal"></add-product>
	</list-template>
</template>

<script>
	
	import { mapGetters } from 'vuex';
	import ListTemplate from '../../templates/ListTemplate';
	import AddProduct from './AddProduct';

	export default {

		async created() {

			const accessToken = localStorage.getItem('accessToken');

			if( accessToken == null || typeof accessToken == 'undefined')
				this.$router.push({ path: '/admin/login' })

			await this.$store.dispatch('getAllProducts');
		},

		methods: {
			openAddProductModal() {
				this.$modal.show('modal-add-product')
			}
		},

		computed: {
			...mapGetters([
				'products'
			])
		},

		components: {
			'list-template': ListTemplate,
			'add-product': AddProduct
		},

		data() {
			return {
				
			}
		}

	}
</script>

<style scoped>
	
</style>