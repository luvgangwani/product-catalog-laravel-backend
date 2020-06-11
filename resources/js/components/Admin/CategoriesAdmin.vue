<template>
	<list-template>
		<div slot="list-header">Categories Dashboard</div>
		<!-- Add Icon -->
		<router-link to="#" class="float-right p-2" slot="list-template-add" v-on:click.native="openAddCategoryModal()">
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
				<router-link v-bind:to="`#`" class="px-2" v-on:click.native="openEditCategoryModal(id)"><img src="../../../images/list-edit.svg" alt="Edit"></router-link>
				<router-link v-bind:to="`#`" class="px-2"><img src="../../../images/list-delete.svg" alt="Delete"></router-link>
			</td>
		</tr>
		<add-category slot="modal"></add-category>
		<edit-category slot="modal"></edit-category>
	</list-template>
</template>

<script>

	import { mapGetters } from 'vuex';
	import ListTemplate from '../../templates/ListTemplate';
	import AddCategory from './AddCategory';
	import EditCategory from './EditCategory';

	export default {

		data() {
			return {
				
			}
		},

		components: {
			'list-template': ListTemplate,
			'add-category': AddCategory,
			'edit-category': EditCategory
		},

		methods: {
			openAddCategoryModal() {
				this.$modal.show('modal-add-category');
			},

			openEditCategoryModal(id) {

				this.$modal.show('modal-edit-category', {
					id
				})

			}
		},

		computed: {
			...mapGetters([
				'categories',
				'isLoading'
			])
		},

		async created() {

			const accessToken = localStorage.getItem('accessToken');

			if(accessToken == null || typeof accessToken == 'undefined')
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