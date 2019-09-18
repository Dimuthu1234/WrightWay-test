<template>
    <div class="table-responsive">
        <form @submit.prevent="updateProduct" class="mb-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Class Room" v-model="product.ProductID">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Teacher's Name"
                       v-model="product.Name">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Student First Name"
                       v-model="product.CostPrice">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Student Last Name"
                       v-model="product.SalePrice">
            </div>
            <button type="submit" class="btn btn-light btn-block">Update</button>

        </form>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link"
                                                                                                href="#"
                                                                                                @click="fetchProducts(pagination.prev_page_url)">Previous</a>
                </li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page
                    }} of {{ pagination.last_page }}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link"
                                                                                                href="#"
                                                                                                @click="fetchProducts(pagination.next_page_url)">Next</a>
                </li>
            </ul>
        </nav>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Cost Price</th>
                <th>Sale Price</th>
                <th width="1%"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products" v-bind:key="product.ProductID">
                <td>{{ product.ProductID }}</td>
                <td>{{ product.Name }}</td>
                <td>{{ product.CostPrice }}</td>
                <td>{{ product.SalePrice }}</td>
                <td><a href="#" @click="editProduct(product)">Edit</a></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
                product: {
                    ProductID: '',
                    Name: '',
                    CostPrice: '',
                    SalePrice: '',
                },
                product_id: '',
                pagination: {},
                edit: false
            }
        },
        created() {
            this.fetchProducts();
        },
        methods: {
            fetchProducts(page_url) {
                let vm = this;
                page_url = page_url || 'api/product';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.products = res.data;
                        vm.makePagination(res.meta, res.links);
                    })
                    .catch(err => console.log(err));
            },
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev,
                };
                this.pagination = pagination;
            },
            updateProduct(){
                    //update
                    fetch(`api/product/${this.product.ProductID}`, {
                        method: 'put',
                        body: JSON.stringify(this.product),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.product.ProductID = '';
                            this.product.Name = '';
                            this.product.CostPrice = '';
                            this.product.SalePrice = '';
                            alert('Products Successfully Updated!')
                            this.fetchProducts();
                        })
                        .catch(err => console.log(err));
                },
            editProduct(product){
                console.log(product)
                this.edit = true;
                this.product.ProductID = product.ProductID;
                this.product.product_id = product.ProductID;
                this.product.Name = product.Name;
                this.product.CostPrice = product.CostPrice;
                this.product.SalePrice = product.SalePrice;
            }
        },
    }
</script>
