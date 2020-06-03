<template>
	<list-template>
		<div slot="list-header">Categories Dashboard</div>
		<!-- Add Icon -->
		<router-link to="/admin/categories" class="float-right p-2" slot="list-template-add">
			<img src="../../../images/list-template-home-plus-icon.svg" class="img-fluid" alt="Add category">
		</router-link>
		<!-- Table Column Headers -->
		<th scope="col" slot="list-table-headers">Category Name</th>
		<th scope="col" slot="list-table-headers">Category URL</th>
		<th scope="col" slot="list-table-headers">Edit/Delete</th>
		<!-- Table Body -->
		<tr v-bind:key="index" v-for="({ id, category_name, category_url, created_at }, index) in categories" slot="list-table-body">
			<td>{{ category_name }}</td>
			<td>{{ category_url }}</td>
			<td>
				<router-link v-bind:to="`/categories/${category_url}`" class="px-2"><img src="../../../images/list-edit.svg"></router-link>
				<router-link v-bind:to="`/categories/${category_url}`" class="px-2"><img src="../../../images/list-delete.svg"></router-link>
			</td>
		</tr>
	</list-template>
</template>

<script>

	import { mapGetters } from 'vuex';
	import ListTemplate from '../../templates/ListTemplate';

	export default {

		data() {
			return {
				
			}
		},

		components: {
			'list-template': ListTemplate
		},

		computed: {
			...mapGetters([
				'categories',
				'isLoading'
			])
		},

		async created() {

			if(localStorage.getItem('accessToken') === 'null')
				this.$router.push({ path: '/admin/login' })

			await this.$store.dispatch('getAllCategories');

		}

	}
</script>

<style scoped>

.table .thead-dark th {
	background-color: #102c48;
	border-color: #102c48;
}
	
</style>