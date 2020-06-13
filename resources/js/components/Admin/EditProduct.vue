<template>
    <modal name="modal-edit-product" height="auto" v-bind:adaptive=true v-on:before-open="beforeOpen">
        <div class="p-5 modal-edit-product-style">
            <div class="h4 text-center">Edit Product</div>
            <form class="mt-3">
                <div class="form-group">
                    <label for="product_name" class="required">Product Name</label>
                    <input type="text" class="form-control" v-model="singleProduct.product_name"> 
                </div>
                <div class="form-group">
                    <label for="product_description" class="required">Product Description</label>
                    <textarea class="form-control" v-model="singleProduct.product_description"></textarea>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" v-model="singleProduct.category_id">
                        <option v-bind:value="id" v-bind:key="index" v-for="({ id, category_name }, index) in categories">{{ category_name }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_price" class="required">Product Price</label>
                    <input type="number" min="0" step="0.01" class="form-control" v-model="singleProduct.product_price">
                </div>
                <button type="submit" class="btn btn-primary btn-lg mt-4" v-on:click.prevent="editProduct()" v-if="!isLoading">Submit</button>
                <button type="submit" class="btn btn-primary btn-lg mt-4" v-if="isLoading" disabled="true">Updating...</button>
                <button type="submit" class="btn btn-primary btn-lg mt-4 ml-2" v-on:click.prevent="closeModal()">Close</button>
            </form>
        </div>
    </modal>
</template>

<script>

import { mapGetters } from "vuex";

export default {

    async created() {
        await this.$store.dispatch('getAllCategories');
    },

    data() {
        return {
            singleProduct: {
                id: 0,
                product_name: '',
                product_description: '',
                category_id: 0,
                product_price: 0.00
            }
        }
    },

    methods: {

        async beforeOpen(event) {

            await this.$store.dispatch('getProductById', event.params.id);
            
            if (this.product != null)
                this.singleProduct = this.product;
                this.singleProduct.category_id = this.product.category.id;

        },

        async editProduct() {
            await this.$store.dispatch('editProduct', this.singleProduct);

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

        closeModal() {
            this.$modal.hide('modal-edit-product');
        }
    },

    computed: {
        ...mapGetters([
            'isLoading',
            'categories',
            'product',
            'successMessage',
            'error'
        ])
    },
}
</script>

<style scoped>
.modal-edit-product-style {
    color: #102c48;
}

.modal-edit-product-style button {
    background-color: #102c48;
    border-radius: 0px;
    color: #ffffff;
}
</style>