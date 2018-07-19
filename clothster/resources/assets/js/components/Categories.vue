<template>
    <div>
        <top></top>
        <b-row>
            <b-col cols="2">
                <div class="categories" align="right">
                    <div v-b-toggle.collapseA>
                        دسته بندی ها
                        <span class="when-opened" style="float:left;">-</span>
                        <span class="when-closed" style="float:left;">+</span>
                    </div>

                    <b-collapse visible id="collapseA" v-b-toggle="'collapseB'+key" class="mt-2"
                                v-for="(item,key) in categories" :key="key"
                                v-if="!item.categories_id" style="margin-right: 20px;">
                        <i class="fa fa-angle-down when-opened"></i>
                        <i class="fa fa-angle-left when-closed"></i>
                        <a v-on:click="fetchProductsByCategoryId(item.id)">
                            {{ item.name }}
                        </a>
                        <b-collapse visible v-for="(jtem,ley) in categories" :key="ley" :id="'collapseB'+key"
                                    v-if="jtem.categories_id == item.id" style="margin-right: 20px;color: silver;">
                            <a v-on:click="fetchProductsByCategoryId(jtem.id)">
                                {{ jtem.name }}
                            </a>
                        </b-collapse>

                    </b-collapse>

                </div>


                <div class="color-picker" align="right">
                    <div v-b-toggle.collapseB>
                        رنگ
                        <span class="when-opened" style="float:left;cursor:pointer;">-</span>
                        <span class="when-closed" style="float:left;cursor:pointer;">+</span>
                    </div>
                    <b-collapse visible id="collapseB" class="mt-2">
                        <b-row class="no-gutters">
                            <b-col md="4">
                                <div v-on:click="fetchProductsByColor('black')" class="color"
                                     style="background-color:black"></div>
                            </b-col>
                            <b-col md="4">
                                <div v-on:click="fetchProductsByColor('gray')" class="color"
                                     style="background-color:gray"></div>
                            </b-col>
                            <b-col md="4">
                                <div v-on:click="fetchProductsByColor('blue')" class="color"
                                     style="background-color:blue"></div>
                            </b-col>
                        </b-row>
                        <b-row class="no-gutters">
                            <b-col md="4">
                                <div v-on:click="fetchProductsByColor('red')" class="color"
                                     style="background-color:red"></div>
                            </b-col>
                            <b-col md="4">
                                <div v-on:click="fetchProductsByColor('yellow')" class="color"
                                     style="background-color:yellow"></div>
                            </b-col>
                            <b-col md="4">
                                <div v-on:click="fetchProductsByColor('green')" class="color"
                                     style="background-color:green"></div>
                            </b-col>
                        </b-row>
                    </b-collapse>
                </div>
            </b-col>
            <b-col cols="10" class="content pr-5 pl-5">
                <b-row class="pb-2">
                    <h4>
                        {{ className }}
                    </h4>
                </b-row>
                <b-row>
                    <b-col class="d-flex justify-content-start">
                        <h6>
                            مرتب سازی
                        </h6>
                        <b-form-select v-model="selected" :options="options" class="mb-3" style="width:150px;">
                        </b-form-select>
                        <div><strong>{{ selected }}</strong></div>
                    </b-col>
                    <b-col class="d-flex justify-content-end">
                        <div class="pagination">
                            <h6>صفحه</h6>
                            <ul class="pagination">
                                <li class="page-item disabled" v-if="currentPage == 0">
                                    <span class="page-link">قبلی</span>
                                </li>
                                <li class="page-item" v-else>
                                    <span class="page-link" v-on:click="prevPage()">قبلی</span>
                                </li>
                                <li class="page-item">
                                    <div class="page-item" style="margin:5px">صفحه {{currentPage}}از{{totalPages}}</div>
                                </li>
                                <li class="page-item disabled" v-if="currentPage == totalPages">
                                    <span class="page-link" v-model="currentPage">بعدی</span>
                                </li>
                                <li class="page-item" v-else>
                                    <span class="page-link" v-on:click="nextPage()" v-model="currentPage">بعدی</span>
                                </li>
                            </ul>
                        </div>
                    </b-col>
                </b-row>
                <b-row>
                    <b-container>
                        <div v-if="products">
                            <b-row>
                                <div v-for="item in products">
                                    <router-link style="cursor: pointer;text-decoration: none"
                                                 :to="'/product/' + item.id">
                                        <b-col>
                                            <div v-if="item.images[0]">
                                                <img class="product-image" :src="item.images[0].image"/>
                                            </div>
                                            <div v-else>
                                                <img class="product-image"
                                                     src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.svg.png"/>
                                            </div>
                                            <div align="center">
                                                {{ item.name}}
                                            </div>
                                            <div align="center">
                                                <div style="color:red">قیمت : {{item.price}}</div>
                                            </div>
                                        </b-col>
                                    </router-link>
                                </div>
                            </b-row>
                        </div>
                    </b-container>
                </b-row>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import Vue from 'vue';

    window.axios = require('axios');
    Vue.component('top', require('./Top.vue'));
    Vue.component('footerr', require('./Footer.vue'));
    import VueSession from 'vue-session'

    Vue.use(VueSession, false)
    export default {
        data() {
            return {
                filter: 0,//0:categories
                currentCategory: 0,
                currentColor: "",
                keyword: this.$route.params.keyword,

                currentPage: 0,
                totalPages: 0,
                perPage: 6,
                categories: null,
                parent: 0,
                className: "",
                products: null,
                selected: null,
                options: [{value: null, text: 'محبوب ترین'}]
            }
        },
        mounted() {
            axios.get('/getCategories')
                .then(response => (this.categories = response.data.categories)).then(response => this.fetchData());
        },
        methods: {
            fetchData() {
                if (this.keyword) {
                    var key = this.keyword.split('=');
                    if (key[0] = 'search') {
                        this.filter = 3;
                        axios.get('/products/name=' + key[1] + ',' + this.currentPage + ',' + this.perPage + '')
                            .then(response => (this.products = response.data));
                    }
                    if (key[0] = 'catId') {
                        this.fetchProductsByCategoryId(key[1]);
                    }
                }
            },
            fetchProductsByColor(color) {
                this.filter = 1;
                this.currentColor = color;
                axios.get('/products/color=' + color + ',' + this.currentPage + ',' + this.perPage + '')
                    .then(response => (this.products = response.data));
                this.className = color;
                axios.get('/productsCount/color=' + color)
                    .then(response => (this.totalPages = Math.floor(response.data.number / this.perPage)));
            },
            fetchProductsByCategoryId(id) {
                this.currentCategory = id;
                this.filter = 0;
                axios.get('/products/category=' + id + ',' + this.currentPage + ',' + this.perPage + '')
                    .then(response => (this.products = response.data));
                this.className = this.findCategoryNameById(id);
                axios.get('/productsCount/category=' + id)
                    .then(response => (this.totalPages = Math.floor(response.data.number / this.perPage)));
            },
            openProduct(id) {
                console.log(id);
            },
            test(id) {
                console.log(id);
            },
            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                    if (this.filter == 0) {
                        this.fetchProductsByCategoryId(this.currentCategory);
                    }
                }
            },
            prevPage() {
                if (this.currentPage > 0) {
                    this.currentPage--;
                    if (this.filter == 0) {
                        this.fetchProductsByCategoryId(this.currentCategory);
                    }
                }
            },
            findCategoryNameById(id){
                for(var i=0; i<this.categories.length ;i++){
                    if(this.categories[i].id == id){
                        return this.categories[i].name
                    }
                }
            }
        }
    };
</script>

<style scoped>
    .product-image {
        width: 200px;
        height: 200px;
        border: solid;
        border-image-width: 10px;
    }

    .categories {
        background-color: #e0edff;
        cursor: pointer;
        padding: 10px;
    }

    .color-picker {
        background-color: #e0edff;
        margin-top: 10px;
        padding: 10px;
    }

    .color {
        margin-top: 10px;
        width: 30px;
        height: 30px;
        cursor: pointer;
    }

    h6 {
        margin: 10px;
    }

    .collapse-toggle:after {
        /* symbol for "opening" panels */
        font-family: 'Glyphicons Halflings'; /* essential for enabling glyphicon */
        content: "\e114"; /* adjust as needed, taken from bootstrap.css */
        float: right; /* adjust as needed */
        color: grey; /* adjust as needed */
    }

    .collapsed > .when-opened,
    :not(.collapsed) > .when-closed {
        display: none;
    }
</style>


