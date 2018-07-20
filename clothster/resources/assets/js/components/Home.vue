<template>
    <div>
        <top></top>
        <slide-show></slide-show>
        <b-row>
            <div class="category-images">
                <router-link v-for="(item,k) in sectionImages" :key="k" :to="item.link">
                    <img :src="item.big">
                    <div class="image-text">
            <span>
                {{item.text}}
            </span>
                    </div>
                </router-link>
            </div>
        </b-row>
        <b-row style="margin-top:40px">
            <b-col>
                <img src="..\img\content\brand.png" style="height: 280px;width: 600px;">
            </b-col>
            <b-col cols="3" style=" margin-left:120px;margin-top:25px">
                <div class="content-col-left" id="khabarname">
                    <li  class="fa fa-envelope-open" align="center" style="margin-top: 40px;"></li>
                    <br>
                    در خبرنامه ما
                    <br>
                    !عضو شوید
                    <br>
                    <input type="text" name="email" class="email" placeholder=" ✉  آدرس ایمیل خود را وارد کنید">
                    <br>
                    <button class="join-btn">عضو شوید</button>
                </div>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import Vue from 'vue';

    Vue.component('Top', require('./Top.vue'));
    Vue.component('SlideShow', require('./SlideShow.vue'));
    export default {
        data(){
            return{
                sectionImages: []
            }
        },
        mounted() {
            axios.get('/home')
                .then(response => (this.setImages(response.data.sections)))
        }
        ,
        methods: {
            setImages(banners) {
                var arr = [];
                for (var i = 0; i < banners.length; i++) {
                    arr[i] = {
                        link: banners[i].bannerLink,
                        big: banners[i].bannerURL,
                        text: banners[i].bannerText,
                    }
                }
                this.sectionImages = arr;
            },
        }
    }
</script>
<style scoped>
    .category-images{
        position: relative;
        display: flex;
        margin-right: 10%;
        margin-left: 10%;
    }
    .category-images img{
        position: relative;
        width: 300px;
        height: 180px;
        border:solid gray 1px;
    }
    .image-text{
        position: absolute;
        top: 130px;
        width: 60px;
    }
    .image-text span{
        color: white;
        display: flex;
        letter-spacing: 1px;
        background: rgb(0, 0, 0); /* fallback color */
        background: rgba(0, 0, 0, 0.7);
        padding: 13px 150px 16px 150px;
    }
    .category-images a{
        opacity: 0.6;
    }
    .category-images a:hover{
        opacity: 1;
    }


    #khabarname{
        background-color: blue;border-radius: 2%;border-color:blue;box-shadow: 0px 10px 30px #7B808C;color: white;
        text-align: center;
    }
    .email{
        direction: ltr;
        border-radius: 20px;
        border:none;
        margin: 25px;
        width: 200px;
        height: 25px;
        color: blue;
        padding-left: 15px;

        border-style: solid;
        border-color: silver;
        border-width: 1px;
        vertical-align:top;
    }
    .join-btn{
        border:none;
        border-radius: 20px;
        background-color: black;
        color: white;
        height: 35px;
        width: 100px;
    }
</style>