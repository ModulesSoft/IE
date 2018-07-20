<template>
    <b-row id="Wrapper">
        <div class="slideshow">
            <div id="slider">
                <img v-for="(item,key) in images" :key="key" v-if="slideIndex == key" :src="item.big" :to="item.link" alt="slide"/>
            </div>
            <div id="Arrows">
                <i @click="prevImage" id="Prev" class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                <i @click="nextImage" id="Next" class="fa fa-chevron-left fa-2x" aria-hidden="true"></i>
            </div>
            <div class="well text-center dots-wrapper">
                <ul>
                    <div class="list-inline dots"
                         v-for="index in  images.length" :key="index"
                         @click="slideIndex = index-1">
                        <li v-if="slideIndex == index-1" class="active"></li>
                    </div>
                </ul>
            </div>
        </div>
    </b-row>
</template>

<script>
    import Vue from 'vue'
    // only import the icons you use to reduce bundle size

    export default {
        data() {
            return {
                images: [],
                slideIndex: 0,
                slideLength: 0
            };
        },
        computed: {
            // currentImage gets called whenever activeImage changes
            // and is the reason why we don't have to worry about the
            // big image getting updated
        },
        mounted() {
            axios.get('/home')
                .then(response => (this.setImages(response.data.banners)))
        }
        ,
        methods: {
            setImages(banners) {
                // console.log(banners[])
                var arr = [];
                for (var i = 0; i < banners.length; i++) {
                    arr[i] = {
                        link: banners[i].bannerLink,
                        big: banners[i].bannerURL
                    }
                }
                this.images = arr;
                this.slideLength = banners.length;
            },
            nextImage() {
                if (this.slideLength > 0 && this.slideIndex < this.slideLength - 1)
                    this.slideIndex++
            },
            prevImage(n) {
                if (this.slideLength > 0 && this.slideIndex > 0)
                    this.slideIndex--
            },
        }
    };
</script>

<style scoped>
    html {
        align-items: center;
        background-color: #31353D;
        display: flex;
        justify-content: center;
        padding: 50px;
        min-height: 100vh;
        direction: ltr;
    }

    #Wrapper {
        align-items: center;
        /* background-color: #EEEFF7; */
        display: flex;
        height: 500px;
        justify-content: center;
        width: 100%;
    }

    #Slideshow {
        align-items: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    #Slider {
        border: 20px solid #000;
        height: 300px;
        overflow: hidden;
        width: 600px;
    }

    #Slider img {
        height: 300px;
        width: 600px;
        transition: all 1s;
    }

    #Arrows {
        display: flex;
        justify-content: space-between;
        /* height: 30px; */
        /* position: absolute; */
        width: 100%;
        z-index: 1;
    }

    #Arrows i {
        background-color: rgba(255, 255, 255, .45);
        color: #1C1D21;
        cursor: pointer;
        margin-top: -210px;
        height: 100%;
        padding: 15px;

        transition: background-color .5s, color .5s;
        z-index: 1;
    }

    #Arrows i:first-of-type {
        padding-right: 20px;
    }

    #Arrows i:last-of-type {
        padding-left: 20px;
    }

    #Arrows i:hover {
        background-color: rgba(28, 29, 33, .75);
        color: #EEEFF7;
    }

    h1 {
        color: #1C1D21;
        font-family: righteous;
        font-size: 2.5em;
        padding: 20px;
    }

    h2 {
        color: #1C1D21;
        font-family: "Open Sans";
        font-size: 1.5em;
        padding: 20px;
    }

    #MeLink {
        background-color: rgba(255, 255, 255, 0);
        border: 10px solid #1C1D21;
        border-radius: 80px;
        bottom: 20px;
        height: 80px;
        overflow: hidden;
        position: fixed;
        right: 20px;
        width: 80px;
        z-index: 2;

        transition: background-color .5s;
    }

    #MeLink:hover {
        background-color: rgba(255, 255, 255, .25);
    }

    #Me {
        border: 10px solid #1C1D21;
        border-radius: 80px;
        bottom: 20px;
        height: 80px;
        position: fixed;
        right: 20px;
        width: 80px;
        z-index: 1;
    }

    .dots-wrapper {
        width: 100%;
        margin: 0 auto;
        margin-top: -50px;
        background-color: #fff;
        /* line-height: 60px; */
        /* border-radius: 0; */
        box-shadow: none;
    }

    .dots {
        display: inline-block;
        height: 20px;
        width: 20px;
        background: white;
        border-radius: 100%;
        border: gray;
        border-style: solid;
        border-width: 1%;
        margin-left: 3px;
        margin-right: 3px;
        cursor: pointer;
        z-index: 10;
    }

    .dots:hover {
        background: #bbb;
    }

    .active {
        margin-right: -3px;
        margin-top: -3px;
        background-color: gray;
        height: 20px;
        width: 20px;
        border-radius: 100%;
    }
</style>

