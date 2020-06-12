<template>
    <modal name="modal-edit-category" height="auto" v-bind:adaptive=true v-on:before-open="beforeOpen">
        <div class="p-5 modal-edit-category-style">
            <div class="h4 text-center">Edit Category</div>
            <form class="mt-3">
                <div class="form-group">
                    <label for="category_name" class="required">Category Name</label>
                    <input type="text" class="form-control" v-model="singleCategory.category_name"> 
                </div>
                <div class="form-group">
                    <label for="category_url" class="required">Category URL</label>
                    <input type="text" class="form-control" v-model="singleCategory.category_url">
                </div>
                <button type="submit" class="btn btn-primary btn-lg mt-4" v-on:click.prevent="editCategory()" v-if="!isLoading">Submit</button>
                <button type="submit" class="btn btn-primary btn-lg mt-4" v-if="isLoading" disabled="true">Updating...</button>
                <button type="submit" class="btn btn-primary btn-lg mt-4 ml-2" v-on:click.prevent="closeModal()">Close</button>
            </form>
        </div>
    </modal>
</template>

<script>

import { mapGetters } from 'vuex';

export default {
    data() {
        return {
            singleCategory: {
                id: null,
                category_name: '',
                category_url: '',
                parent_id: 0
            },
            submitDisabled: true
        }
    },
    methods: {

        async editCategory() {
            await this.$store.dispatch('editCategory', this.singleCategory)

            if (this.successMessage != null) {
                Vue.$toast.open({
                    message: this.successMessage,
                    type: 'success'
                });
                this.closeModal();
            }

            if (this.error != null)
                Vue.$toast.open({
                    message: this.error,
                    type: 'error'
                });
        },

        async beforeOpen(event) {
            await this.$store.dispatch('getCategoryById', event.params.id);

            if (this.category != null) {
                this.singleCategory = this.category
            }
        },

        closeModal() {
            this.$modal.hide('modal-edit-category');
        }
    },
    computed: {
        ...mapGetters([
            'isLoading',
            'category',
            'successMessage',
            'error'
        ])
    },
    watch: {
        singleCategory: {
            handler(newCategory, oldCategory) {
                this.category.category_url = this.category.category_name.toLowerCase().replace(/ /g, '-');
            },
            deep: true
        }
    },
}
</script>

<style scoped>

.modal-edit-category-style {
    color: #102c48;
}

.modal-edit-category-style button {
    background-color: #102c48;
    border-radius: 0px;
    color: #ffffff;
}

</style>