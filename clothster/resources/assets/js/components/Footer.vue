<template>
    <div class="footer">
        <div class="footer-container" align="center">
            <div class="footer-col" align="right">
                <div class="mb-3"><strong>خدمات مشتریان</strong></div>
                <p>سوالات متداول</p>
                <p>بازگرداندن کالا</p>
                <p>شرایط استفاده</p>
                <p>حریم شخصی</p>
            </div>
            <div class="footer-col">
                <div class="mb-3"><strong>اطلاعات ما</strong></div>
                <p>درباره ما</p>
                <p>تماس باما</p>
            </div>
            <div class="footer-col">
                <div class="mb-1"><strong>به ما در رسانه های اجتماعی بپیوندید</strong></div>
                <br>
                <a href="#">
                    <div id="facebook"></div>
                </a>
                <a href="#">
                    <div id="twitter"></div>
                </a>
                <a href="#">
                    <div id="gplus"></div>
                </a>
                <br>
                <a href="#">
                    <div id="facebook"></div>
                </a>
                <a href="#">
                    <div id="twitter"></div>
                </a>
                <a href="#">
                    <div id="gplus"></div>
                </a>
            </div>
            <div class="footer-col">
                <p>
                    {{rights}}
                </p>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                rights: ""
            }
        },
        mounted() {
            axios.get('/home')
                .then(response => (this.setTexts(response.data.promotions)))
        },
        methods:{
            setTexts(promotions)
            {
                console.log(promotions)
                this.rights = promotions[0].rights;
            }
        }
    };
</script>
<style scoped>
    .footer {
        background-color: silver;
        width: 100% !important;
        /* position: absolute; */
        direction: rtl;
    }

    .footer-container {
        padding: 10px 150px 10px 150px;
        display: inline-flex;
    }

    .footer-col {
        width: 20%;
        display: inline-block;
        margin: 2%;
    }

    #facebook {
        background: url("../img/facebook.png");
        width: 50px;
        height: 50px;
        display: inline-block;
    }

    #twitter {
        background: url("../img/twitter.png");
        width: 50px;
        height: 50px;
        display: inline-block;
    }

    #gplus {
        background: url("../img/gplus.png");
        width: 50px;
        height: 50px;
        display: inline-block;
    }

    #facebook:hover {
        background: url("../img/facebook-hover.png");
    }

    #twitter:hover {
        background: url("../img/twitter-hover.png");
    }

    #gplus:hover {
        background: url("../img/gplus-hover.png");
    }
</style>