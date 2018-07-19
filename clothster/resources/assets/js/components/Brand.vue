<template>
    <b-row>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
        <b-col>
            <b-row v-if="user == null">
                <b-col align="left">
                    <div class="btnborder" >
                        <a @click="toggle" class="abtn">login</a>
                        <modal v-if="this.showModal" @close="toggle" @user="setUser"></modal>
                    </div>
                </b-col>
                <b-col align="right">
                    <div class="btnborder" >
                        <a class="abtn">register</a>
                    </div>
                </b-col>
            </b-row>
            <b-row v-else>
                <b-col cols="3">
                    <div align="center">
                        {{user.username}}
                        <i class="fa fa-angle-down" @click="logout"></i>
                    </div>
                </b-col>
                <b-col cols="4">
                    <router-link to="/cart" style="text-decoration: none"  align="center">
                        سبد خرید
                        <i class="fa fa-shopping-basket"></i>
                    </router-link>
                </b-col>
                <b-col cols="5">
                    <div align="center">
                        پیگیری سفارش
                        <i class="fa fa-clipboard-list"></i>
                    </div>
                </b-col>
            </b-row>
        </b-col>
        <b-col>
            <b-row>
                <b-col align="center">
                    <router-link class="brand_word" to="/">Clothster</router-link>
                </b-col>
            </b-row>
        </b-col>
        <b-col>
            <search></search>
        </b-col>
    </b-row>
</template>

<script>
    import search from "./Search.vue";
    import modal from "./Modal.vue";
    import VueSession from 'vue-session'
    import Vue from "vue"
    Vue.use(VueSession)

    export default {
        components: {
            search,
            modal
        },
        data() {
            return {
                showModal: false,
                user: null
            };
        },
        // watch: {
        //         user: null
        // },
        mounted: function () {
            if (!this.$session.exists()) {
                this.$router.push('/')
            } else {
                this.user = this.$session.getAll().user;
            }
        },
        methods: {
            toggle: function () {
                this.showModal = !this.showModal;
            },
            setUser: function (e) {
                this.user = e;
            },
            logout: function () {
                this.$session.destroy()
                window.location.href = "/logout";
                // this.$router.push('/logout')
            }
        }
    };

    // start app
    // new Vue({
    //   el: '#app',
    //   data: {
    //     showModal: false
    //   }
    // })
</script>

<style scoped>
    .brand_word {
        text-decoration: none;
        color: silver;
        font-size: 30px;
    }

    .btnborder {
        display: inline-block;
        border-style: solid;
        border-radius: 20px;
        border-color: silver;
        background-color: silver;
        padding: 5px 30px 5px 30px;
        cursor: pointer;
    }

    .abtn {
        text-decoration: none;
        color: white !important;
    }
</style>