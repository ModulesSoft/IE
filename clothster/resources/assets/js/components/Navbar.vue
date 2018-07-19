<template>
<div>
    <div class="navbar" align="center">
        <div v-for="item in categories" v-if="!item.categories_id">
            <router-link   :to="'/search/catId='+item.id" class="navbar-content">{{item.name}}</router-link>
        </div>
        <!--<a href="#" class="navbar-content">زنانه</a>-->
        <!--<a href="#" class="navbar-content">بچگانه</a>-->
        <!--<a href="#" class="navbar-content">ورزشی</a>-->
        <!--<a href="#" class="navbar-content">تخفیف ها</a>-->
        <!--<a href="#" class="navbar-content">برندها</a>-->
    </div>
    <hr>
</div>
</template>

<script>
    export default {
        data() {
            return{
                categories : null
            }
        },
        mounted(){
            axios.get('/getCategories')
            .then(response => (this.categories = response.data.categories))
        }
    }
</script>

<style scoped>
    .navbar{
        padding-top: 20px;
        margin-left:10%;
        margin-right: 10%;
        direction:rtl;
    }
    .navbar-content {
        display: inline-block;
        text-decoration: none;
        /* color: silver; */
        margin-left: 2%
    }
</style>