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
				<router-link to="#" class="px-2" v-on:click.native="openEditProductModal(id)"><img src="../../../images/list-edit.svg"></router-link>
				<router-link to="#" class="px-2"><img src="../../../images/list-delete.svg"></router-link>
			</td>
		</tr>
		<add-product slot="modal"></add-product>
		<edit-product slot="modal"></edit-product>
	</list-template>
</template>

<script>
	
	import { mapGetters } from 'vuex';
	import ListTemplate from '../../templates/ListTemplate';
	import AddProduct from './AddProduct';
	import EditProduct from './EditProduct';

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
			},

			openEditProductModal(id) {
				this.$modal.show('modal-edit-product', {
					id
				})
			}
		},

		computed: {
			...mapGetters([
				'products'
			])
		},

		components: {
			'list-template': ListTemplate,
			'add-product': AddProduct,
			'edit-product': EditProduct
		},

		data() {
			return {
				
			}
		}

	}
</script>

<style scoped>
	
</style>