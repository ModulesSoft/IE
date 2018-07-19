<template>
    <div>
        <b-row>
            <b-col>
                <brand></brand>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <navbar></navbar>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import Vue from 'vue';

    Vue.component('brand', require('./Brand.vue'));
    Vue.component('navbar', require('./Navbar.vue'));
</script>

<style>
    html {
        direction: rtl;
    }

    .container {
        margin: 10%;
        margin-top: 2%;
    }

    @font-face {
        font-family: yekan;
        src: url("../font/Yekan.ttf");
    }

    body {
        font-family: yekan;
        margin: 0;
        color: #6e727d;
        font-size: 90%;
    }

    hr {
        border: none;
        height: 1px;
        color: #d9deec; /* old IE */
        background-color: #d9deec; /* Modern Browsers */
    }

    .vertical-line {
        border-left: 1px solid silver;
        height: 65px;
    }

    a {
        text-decoration: none;
        color: silver;
    }

    a:hover {
        color: gray;
    }

    .block {
        direction: rtl;
    }

    .block_button {
        display: inline-block;
        width: 120px;
        height: 150px;
        padding-right: 40px;
        padding-left: 40px;
        margin: 30px;
        border-style: solid;
        border-radius: 10px;
        border-width: 1px;
        border-color: silver;
    }

    .block_button:hover {
        box-shadow: 0px 0px 4px #76aedd;
    }

    .block_button span {
        display: block;
        width: 100%;
        text-align: center;
        padding-top: 120px;
    }

    #about {
        background: url("../img/about.png");
        height: 120px;
        width: 120px;
    }

    #about:hover {
        background: url("../img/about-hover.png");
        color: #76aedd;
    }

    #contact {
        background: url("../img/contact.png");
        height: 120px;
        width: 120px;
    }

    #contact:hover {
        background: url("../img/contact-hover.png");
        color: #76aedd;
    }

    #return {
        background: url("../img/return.png");
        height: 120px;
        width: 120px;
    }

    #return:hover {
        background: url("../img/return-hover.png");
        color: #76aedd;
    }
</style>
