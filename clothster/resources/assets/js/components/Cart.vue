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
                <tr>
                    <th scope="col">مشخصات محصول</th>
                    <th scope="col">تعداد</th>
                    <th scope="col">قیمت</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                </tr>
                </tbody>
            </table>
        </b-row>
        <b-row>
            <div style="margin-right: 44%;color:red">
                {{noOrder}}
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
                products: []
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
                        .then(response => (this.products[i][0] = response.data.name)).then(response => (this.products[i][1] = response.data.images[0]))
                    // var size = this.$session.getAll().sizes[i];
                    // items[i][2] = this.$session.getAll().colors[i];
                }
            } else {
                this.noOrder = "سبدخرید شما خالی است";
            }
        }
    }
</script>

<style scoped>
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