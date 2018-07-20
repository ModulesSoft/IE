<template>
    <div>
        <top></top>
        <b-row>
            <div class="line"></div>
            <div class="circle">
                <i class="fas fa-cart-arrow-down" style="font-size: 45px;margin: 20px;margin-top: 0"></i>
            </div>
        </b-row>
        <b-row style="margin-top: 20px" align="center">
            <table class="table">
                <thead class="thead-light">
                <tr align="center">
                    <th scope="col">مشخصات محصول</th>
                    <th scope="col">تعداد</th>
                    <th scope="col">قیمت</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(name,i) in names" :key="i" align="center">
                    <td style="width: 300px">
                        <div class="itemImage">
                            <img :src="images[i]" class="itemImage"/>
                        </div>
                        <div class="itemName">{{names[i]}}</div>
                    </td>
                    <td>
                        <div style="width: 100px">
                            <i @click="plus(i)" class="fas fa-plus-circle"
                               style="font-size:30px;float:right;cursor: pointer"></i>
                            <input style="float:right;margin-right: 15px;width: 15px" disabled :value="numbers[i].count">
                            <i @click="minus(i)" class="fas fa-minus-circle"
                               style="font-size:30px;float:left;cursor: pointer"></i>
                        </div>
                    </td>
                    <td>
                        <div>{{prices[i]*numbers[i].count}}</div>
                    </td>
                </tr>
                </tbody>
            </table>
        </b-row>
        <b-row>
            <div style="margin-right: 44%;color:red">
                <div v-if="noOrder">
                    {{noOrder}}
                </div>
                <div v-else>
                    <button type="button" class="btn btn-info"
                            style="width:150px;border-radius: 30px;background-color: blue" @click="send()">
                        ثبت
                    </button>
                </div>
            </div>
        </b-row>
    </div>
</template>

<script>
    import Vue from 'vue';

    Vue.component('Top', require('./Top.vue'));
    export default {
        data() {
            return {
                noOrder: null,
                prices: [],
                images: [],
                names: [],
                numbers: []
            }
        },
        mounted() {
            if (this.$session.getAll().items) {
                // console.log(this.$session.getAll().items.length)
                // console.log(this.$session.getAll().colors[0])
                // console.log(this.$session.getAll().sizes[0])
                for (var i = 0; i < this.$session.getAll().items.length; i++) {
                    var id = this.$session.getAll().items[i];
                    console.log(i)
                    axios.get('/getProduct/' + id)
                        .then(response => (this.images.push(response.data.images[0].image)))//.then(response => (this.names.push(response.data.name)))
                    axios.get('/getProduct/' + id)
                        .then(response => (this.names.push(response.data.name)))
                    axios.get('/getProduct/' + id)
                        .then(response => (this.prices.push(response.data.price)))
                    this.numbers.push({id: i, count: 1})
                    // images.push()
                    // var size = this.$session.getAll().sizes[i];
                    // items[i][2] = this.$session.getAll().colors[i];
                }
            } else {
                this.noOrder = "سبدخرید شما خالی است";
            }
        },
        methods: {
            send() {
                var totalPrice = 0
                var j = 0
                for(var i in this.prices){
                    totalPrice += this.prices[j]*this.numbers[j].count;
                    j++
                }
                // console.log(totalPrice);

                axios.post('/order',
                    {
                        products: this.$session.getAll().items,
                        totalPrice: totalPrice,
                        address: 'abcde',
                        paymentType: 2,
                        userId: this.$session.getAll().user.id,
                        status: 0,
                        deliveryTime: 90
                    }
                ).then(response => (this.validate(response)));
            },
            validate(response) {
                if (response.data == 'ok') {
                    this.$session.set('items', null);
                    this.$session.set('colors', null);
                    this.$session.set('sizes', null);
                    window.location = "/"
                }
            },
            plus(id) {
                console.log(this.numbers[id])
                this.numbers[id].count = this.numbers[id].count + 1
            },
            minus(id) {
                console.log(this.numbers[id])
                if (this.numbers[id].count > 1)
                    this.numbers[id].count = this.numbers[id].count  - 1
            }
        }
    }
</script>

<style scoped>
    .itemName {
        float: left;
        margin-left: 100px;
    }

    .itemImage {
        float: right;
        width: 100px;
        height: 100px;
        border: solid 3px;
    }

    .circle {
        margin-top: -4px;
        margin-right: 46%;
        width: 100px;
        height: 50px; /* as the half of the width */
        background-color: white;
        border-bottom-left-radius: 60px; /* 100px of height + 10px of border */
        border-bottom-right-radius: 60px; /* 100px of height + 10px of border */
        border: 3px solid #2a88bd;
        /*border-bottom: 10px;*/
        border-top: 0;

    }

    .line {
        background-color: #2a88bd;
        width: 100%;
        padding: 2px;
        margin-top: 20px;
    }

</style>