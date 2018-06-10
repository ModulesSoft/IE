<template>
    <div>
        <div class="container">
            <brand></brand>
            <navbar></navbar>
            <nuxt/>
        </div>
        <footerr></footerr>
    </div>
</template>

<script>
import brand from "~/components/Brand.vue";
import navbar from "~/components/Navbar.vue";
import footer from "~/components/Footer.vue";
export default {
  components: {
    'brand': brand,
    'navbar': navbar,
    'footerr': footer
  }
};
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
  src: url("~/assets/font/Yekan.ttf");
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
  background: url("~/assets/img/about.png");
  height: 120px;
  width: 120px;
}

#about:hover {
  background: url("~/assets/img/about-hover.png");
  color: #76aedd;
}

#contact {
  background: url("~/assets/img/contact.png");
  height: 120px;
  width: 120px;
}

#contact:hover {
  background: url("~/assets/img/contact-hover.png");
  color: #76aedd;
}

#return {
  background: url("~/assets/img/return.png");
  height: 120px;
  width: 120px;
}

#return:hover {
  background: url("~/assets/img/return-hover.png");
  color: #76aedd;
}
</style>
