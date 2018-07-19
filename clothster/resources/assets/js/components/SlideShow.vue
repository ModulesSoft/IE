<template>
    <section id="Wrapper">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <div class="slideshow">
            <div id="slider">
                <img :src="currentImage" alt="slide"/>
            </div>
            <div id="Arrows">
                <i @click="prevImage" id="Prev" class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                <i @click="nextImage" id="Next" class="fa fa-chevron-left fa-2x" aria-hidden="true"></i>
            </div>
            <div class="well text-center dots-wrapper">
                <ul>
                    <div class="list-inline dots"
                         v-for="index in  images.length" :key="index"
                         @click="actviateImage(index-1)">
                        <li v-if="activeImage == index-1" class="active"></li>
                    </div>
                </ul>
            </div>
        </div>
    </section>
</template>

<script>
    import Vue from 'vue'
    // only import the icons you use to reduce bundle size

    export default {
        data() {
            return {
                images: [
                    {
                        id: "1",
                        big: "http://aacerflooring.in/wp-content/uploads/2012/12/banner-fallmaples-960x360.jpg"
                    },
                    {
                        id: "2",
                        big:
                            "http://wowslider.com/sliders/demo-6/data/images/greenmountain.jpg"
                    },
                    {
                        id: "3",
                        big:
                            "http://wowslider.com/sliders/demo-42/data1/images/lighthouse.jpg"
                    },
                    {
                        id: "4",
                        big:
                            "http://wowslider.com/sliders/demo-37/data1/images/mountainlandscape.jpg"
                    }
                ],
                activeImage: 0
            };
        },
        computed: {
            // currentImage gets called whenever activeImage changes
            // and is the reason why we don't have to worry about the
            // big image getting updated
            currentImage: function () {
                return this.images[this.activeImage].big;
            }
        },
        methods: {
            nextImage: function () {
                this.activeImage = this.activeImage + 1;
                if (this.activeImage >= this.images.length) {
                    this.activeImage = 0;
                }
            },
            prevImage: function () {
                this.activeImage = this.activeImage - 1;
                if (this.activeImage <= 0) {
                    this.activeImage = 0;
                }
            },
            actviateImage: function (event) {
                this.activeImage = event;
            }
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

