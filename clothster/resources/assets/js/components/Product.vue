<template>
    <div>
        <top></top>
        <b-container>
            <div v-if="product">
                <b-row>
                    <b-col cols="1">
                        <b-row align-h="center">
                            <li class="fa fa-chevron-up" style="margin:10px;cursor: pointer"
                                @click="prevImage"></li>
                        </b-row>
                        <div  style="height:230px">
                        <b-row align-h="center">
                            <img v-for="(item , key) in product.images" style="margin: 5px" class="thumbnail"
                                 v-bind:src="item.image" v-bind:key="key" @click="setMainImage(key)">
                        </b-row>
                        </div>
                        <b-row align-h="center">
                            <li class="fa fa-chevron-down" style="margin:10px;cursor: pointer"
                                @click="nextImage"></li>
                        </b-row>
                    </b-col>
                    <b-col cols="3" style="margin-left: 100px;">
                        <img class="image" v-bind:src="product.images[mainImage].image">
                    </b-col>
                    <b-col cols="3">
                        <b-row style="margin: 20px">
                            <b-col align="right">
                                {{ product.name }}
                            </b-col>
                        </b-row>
                        <b-row style="margin: 20px">
                            <div>قیمت:</div>
                            <b-col align="right">
                                {{ product.price }} تومان
                            </b-col>
                        </b-row>
                        <b-row style="margin: 20px">
                            <div>رنگ:</div>
                            <b-col v-for="(item,key) in product.colors" :key="key">
                                <div @click="setColor(item.id)" v-bind:style="'background-color: '+item.color" class="colors">
                                </div>
                            </b-col>
                        </b-row>
                        <b-row style="margin: 20px;margin-left:0;">
                            <div align="right">سایز:</div>
                            <b-col>
                                <b-form-select class="mb-3" v-model="orderSize" :options="sizes">
                                </b-form-select>
                            </b-col>
                        </b-row>
                        <b-row style="margin: 20px">
                            <b-button variant="danger" @click="addItem(product.id)">افزودن به سبد خرید</b-button>
                        </b-row>
                        <b-row>
                            ضمانت در خرید و ....
                        </b-row>
                    </b-col>
                </b-row>
                <b-row style="margin-top: 100px">
                    <!--<b-col>-->
                    <div>
                        توضیحات:
                    </div>
                    <div style="margin:20px">
                        {{product.discription}}
                    </div>
                    <!--</b-col>-->
                </b-row>
            </div>
        </b-container>
    </div>
</template>

<script>
    import Vue from 'vue';

    window.axios = require('axios');
    Vue.component('top', require('./Top.vue'));
    // Vue.component('footerr', require('./Footer.vue'));
    export default {
        name: "Product",
        data() {
            return {
                id: this.$route.params.id,
                product: null,
                mainImage: 0,
                totalImages: 0,
                post: null,
                err: null,
                orderColor : 0,
                orderSize: 0,
                sizes : []
            }
        },
        created() {
            this.fetchData()
        },
        methods: {
            setColor(id){
                this.orderColor = id;
            },
            setSize(pr){
                var sz = []
                for(var i=0 ; i<pr.sizes.length ; i++){
                    var obj = { value: pr.sizes[i].id, text: pr.sizes[i].size }
                    sz[i] = obj;
                }
                this.sizes=sz
            },
            fetchData() {
                axios.get('/getProduct/' + this.id)
                    .then(response => (this.product = response.data)).then(response => (this.totalImages = this.product.images.length)).then(response => (this.setSize(this.product)));
            },
            setMainImage(id) {
                this.mainImage = id;
            },
            prevImage() {
                console.log(this.selected)
                if (this.mainImage > 1)
                    this.mainImage--;
            },
            nextImage() {
                if (this.mainImage < this.totalImages - 1)
                    this.mainImage++;
            },
            addItem(id){
                // var items =[];
                if(this.$session.getAll().items) {
                    var duplicated = false;
                    for (var i = 0; i < this.$session.getAll().items.length; i++) {
                        if (id == this.$session.getAll().items[i]) {
                            duplicated = true;
                            break;
                        }
                    }
                    if(!duplicated){
                        if(this.orderColor>0 && this.orderSize>0){
                            console.log('umad1'+this.orderSize+' '+this.orderColor)
                            var items = this.$session.getAll().items;
                            items.push(id);
                            var colors = this.$session.getAll().colors;
                            colors.push(this.orderColor);
                            var sizes = this.$session.getAll().sizes;
                            sizes.push(this.orderSize);
                            this.$session.set('items', items);
                            this.$session.set('colors', colors);
                            this.$session.set('sizes', sizes);
                        }
                    }
                }else{
                    // this.$session.set('items', [id]);
                    if(this.orderColor>0 && this.orderSize>0){
                        console.log('umad'+this.orderSize+' '+this.orderColor)
                        this.$session.set('items', [id]);
                        this.$session.set('colors', [this.orderColor]);
                        this.$session.set('sizes', [this.orderSize]);
                    }
                }
                console.log(this.$session.getAll().items)
                console.log(this.$session.getAll().colors)
                console.log(this.$session.getAll().sizes)
            }
        }
    }
</script>

<style scoped>
    .thumbnail {
        width: 70px;
        height: 70px;
        cursor: pointer;
    }
.colors{
    width: 30px;
    height: 30px;
    border-style: solid;
    border-width: 2px;
    border-radius: 5px;
    cursor: pointer;
}
    .image {
        width: 300px;
        height: 300px;
        /*float:right;*/
    }
</style>