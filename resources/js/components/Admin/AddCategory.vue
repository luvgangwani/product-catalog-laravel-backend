<template>
    <modal name="modal-add-category" height="auto" v-bind:adaptive=true>
        <div class="p-5 modal-add-category-style">
            <div class="h4 text-center">Add New Category</div>
            <form class="mt-3">
                <div class="form-group">
                    <label for="category_name" class="required">Category Name</label>
                    <input type="text" class="form-control" v-model="category.category_name"> 
                </div>
                <div class="form-group">
                    <label for="category_url" class="required">Category URL</label>
                    <input type="text" class="form-control" v-model="category.category_url">
                </div>
                <button type="submit" class="btn btn-primary btn-lg mt-4">Submit</button>
                <button type="submit" class="btn btn-primary btn-lg mt-4 ml-2" v-on:click.prevent="closeModal()">Close</button>
            </form>
        </div>
    </modal>
</template>

<script>
export default {
    data() {
        return {
            category: {
                category_name: '',
                category_url: '',
                parent_id: 0
            }
        }
    },

    methods: {

        closeModal() {
            this.$modal.hide('modal-add-category');
        }
    },

    watch: {
        category: {
            handler() {
                console.log("Watching...")
                this.category.category_url = this.category.category_name.toLowerCase().replace(/ /g, '-')
            },
            deep: true
        }
    },
}
</script>

<style scoped>

.modal-add-category-style {
    color: #102c48;
}

.modal-add-category-style button {
    background-color: #102c48;
    border-radius: 0px;
    color: #ffffff;
}

</style>