<template>
    <div>
        <top></top>
        <b-row>
            <b-col>
                <div class="form-element">
                    نام کاربری<br>
                    <input type="text" disabled :value="this.$session.getAll().user.username">
                </div>
                <div class="form-element">
                    شماره تلفن همراه<br>
                    <input type="tel" name="site">
                </div>
                <div class="form-element">
                    تاریخ تولد<br>
                    <input type="date" name="email">
                </div>
                <div class="form-element" style="margin-top: 90px">
                    رمز عبور قدیم<br>
                    <input type="password" v-model="pass0">
                </div>
            </b-col>
            <b-col>
                <div align="center">
                    <div>{{ this.$session.getAll().user.username}}</div>
                    <img :src="this.$session.getAll().user.avatarURL" class="avatarImage">
                    <div class="form-element" style="margin-top: 10px;">
                        رمز عبور جدید<br>
                        <input type="password" v-model="pass1">
                    </div>
                    <button type="button" class="btn btn-info mt-5"
                            style="width:250px;border-radius: 30px;background-color: blue" @click="editUser()">
                        ثبت تغییرات
                    </button>
                    <div style="color:red;margin-top: 10px">
                        {{error}}
                    </div>
                    <div style="color:green;margin-top: 10px">
                        {{success}}
                    </div>
                </div>
            </b-col>
            <b-col>
                <div class="form-element">
                    شهر<br>
                    <input type="text">
                </div>
                <div class="form-element">
                    تلفن ثابت<br>
                    <input type="text">
                </div>
                <div class="form-element">
                    شماره کارت<br>
                    <input type="text">
                </div>
                <div class="form-element" style="margin-top: 90px">
                    تکرار رمز عبور جدید<br>
                    <input type="password" v-model="pass2">
                </div>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <table class="table">
                    <thead class="thead-light">
                    <tr align="center">
                        <th scope="col" style="width: 500px">آدرس</th>
                        <th scope="col">شهر</th>
                        <th scope="col" style="width: 100px">مختصات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in addresses" align="center">
                        <td style="width: 300px">
                            <div>{{ item.addressText }}</div>
                        </td>
                        <td>
                            <div>{{ item.city }}</div>
                        </td>
                        <td>
                            <div style="float:right"> {{ item.lat }}</div>
                            <div style="float:left">{{ item.lon }}</div>
                        </td>
                    </tr>
                    <tr align="center">
                        <th scope="col">
                            <li class="fa fa-plus" style="margin-left:20px;color:blue"></li>
                            <input style="border-radius: 10px" v-model="address"></th>
                        <th scope="col"><input style="border-radius: 10px" v-model="city"></th>
                        <th scope="col">
                            <div style="float:right"><input style="width:30px;border-radius: 10px" v-model="lat"></div>
                            <div style="float:left"><input style="width:30px;border-radius: 10px" v-model="lon"></div>
                        </th>
                    </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-info mt-5"
                        style="margin-left: 39%;width:250px;border-radius: 30px;background-color: blue"
                        @click="editAddress()">
                    ثبت آدرس جدید
                </button>
            </b-col>
        </b-row>
        <b-col>
            <table class="table">
                <thead class="thead-light">
                <tr align="center">
                    <th scope="col">ردیف</th>
                    <th scope="col">کد</th>
                    <th scope="col">تاریخ و ساعت</th>
                    <th scope="col">مبلغ کل</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">عملیات</th>
                    <th scope="col">جزییات</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,key) in orders" :key="key" align="center">
                    <td>
                        <div>{{ key }}</div>
                    </td>
                    <td>
                        <div>{{ item.id }}</div>
                    </td>
                    <td>
                        <div> {{ item.created_at }}</div>
                    </td>
                    <td>
                        <div> {{ item.totalPrice }}</div>
                    </td>
                    <td>
                        <div v-if="item.status==0">پرداخت نشده</div>
                        <div v-if="item.status==1">پرداخت شده</div>
                    </td>
                    <td>
                        <div v-if="item.status==0">
                            <button type="button" class="btn btn-info">
                                پرداخت
                            </button>
                        </div>
                        <div v-else>
                            <button type="button" disabled class="btn btn-warning">
                                پرداخت
                            </button>
                        </div>
                    </td>
                    <td>
                        <i class="fas fa-angle-down" @click="getOrderProducts(item.id)"
                           style="font-size: 20px;cursor: pointer"></i>
                    </td>
                </tr>
                </tbody>
            </table>
            <!--<div v-for="product in products">-->
            <!--{{product.name}}-->
            <!--</div>-->
            <b-row v-if="products">
                <table class="table">
                    <thead class="thead-light">
                    <tr align="center">
                        <th scope="col">مشخصات محصول</th>
                        <th scope="col">تعداد</th>
                        <th scope="col">قیمت</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(product,key) in products" :key="key" align="center" v-if="product.id">
                        <td>
                            <div class="itemImage">
                                <img src="https://www.w3schools.com/w3css/img_lights.jpg" class="itemImage"/>
                            </div>
                            <div class="itemName">{{product.name}}</div>
                        </td>
                        <td>
                            ثبت نمیشود!
                        </td>
                        <td>
                            <div>{{product.price}}</div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </b-row>
        </b-col>
    </div>
</template>

<script>
    import Vue from 'vue';

    Vue.component('Top', require('./Top.vue'));
    export default {
        data() {
            return {
                pass0: '',
                pass1: '',
                pass2: '',
                username: '',
                error: '',
                success: '',
                addresses: null,
                address: "",
                city: "",
                lat: "", lon: "",
                orders: null,
                products: null
            }
        },
        mounted() {
            axios.get('user/getAddresses/' + this.$session.getAll().user.id)
                .then(response => (this.addresses = response.data))//.then(response => (this.names.push(response.data.name)))
            axios.get('user/getAddresses/' + this.$session.getAll().user.id)
                .then(response => (this.addresses = response.data))//.then(response => (this.names.push(response.data.name)))
            axios.get('getOrder/' + this.$session.getAll().user.id)
                .then(response => (this.orders = response.data))//.then(response => (this.names.push(response.data.name)))
        },
        methods: {
            editUser() {
                var pass = ''
                if (this.pass0) {
                    if (this.username) {
                        //
                    } else {
                        // this.error = "username can't be empty"
                    }
                    //change password
                    if (this.pass1 || this.pass2) {
                        if (this.pass1 == this.pass2) {
                            axios.post('/editUser',
                                {
                                    users_id: this.$session.getAll().user.id,
                                    username: this.$session.getAll().user.username,
                                    password: this.pass1,
                                    avatarURL: this.$session.getAll().user.avatarURL
                                }
                            ).then(response => (this.success = "password successfully changed!"));

                        } else {
                            this.error = "passwords don't match"
                        }
                    }
                } else {
                    this.error = "fill current password correctly"
                }
            },
            editAddress() {
                axios.post('/user/addresses',
                    {
                        users_id: this.$session.getAll().user.id,
                        addressText: this.address,
                        city: this.city,
                        lat: this.lat,
                        lon: this.lon
                    }
                ).then(response => (this.$router.go()));
            },
            getOrderProducts(id) {
                axios.get('/getOrderProducts/' + id)
                    .then(response => (this.products = response.data))
            }
        }
    }
</script>

<style scoped>
    .avatarImage {
        width: 200px;
        height: 200px;
        border-radius: 100px;
        border-style: solid;
    }

    .form-element {
        text-align: right;
        float: right;
        display: inline-block;
        margin-right: 5%;
        font-size: 80%;
        color: blue;
    }

    .form-element input {
        border-radius: 20px;
        width: 300px;
        border-color: silver;
        border-style: solid;
        border-width: 1px;
        background-color: #DAE5F0;
        height: 30px;
        padding-right: 15px;
    / / padding-left: 15 px;
        direction: rtl;
    }

    .form-element textarea {
        border-radius: 20px;
        width: 650px;
        height: 150px;
        border-color: silver;
        border-style: solid;
        border-width: 1px;
        background-color: #DAE5F0;
        padding: 2%;
        margin: 2%;
        /*margin-bottom: 100px;*/
        resize: none;
        direction: rtl;
    }

    .contact-form button {
        border-radius: 20px;
        color: blue;
        border-style: solid;
        border-color: blue;
        width: 200px;
        height: 30px;
        background-color: white;
        border-width: 1px;
        margin-left: 8%;
        float: left;
        cursor: pointer;
    }

    .itemImage {
        float: right;
        width: 100px;
        height: 100px;
        border: solid 3px;
    }
</style>