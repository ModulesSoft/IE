<template>
    <div class="search" style="float:left;display: inline-block;">

        <input class="searchTerm" placeholder="جستجو..." type="text" style="font-weight: bold;" v-model="keyword" @keydown="inputHandler"/>

        <button type="submit" class="searchButton" @click="send" >
            <i class="fa fa-search"></i>
        </button>
    </div>
</template>

<script>
    export default{
        name: 'search',
        data(){
            return {
                keyword: ''
            }
        },
        methods:{
            send(){
                if(this.keyword)
                    window.location.href = "/search/search="+this.keyword;
            },
            inputHandler: function(event){
                if(event.code === 'Enter')
                    this.$emit('searched', this.send());
            }
        }
    }
</script>

<style scoped>
    @import url("//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css");
    .search {
        /*width: 100%;*/
        position: relative
    }
    .search ::placeholder{
        direction: rtl;
    }
    .searchTerm {
        float: left;
        width: 80%;
        border: 2px solid silver;
        padding: 5px;
        height: 25px;
        border-radius: 15px;
        outline: none;
        color: #9DBFAF;
        padding-left:15%;
        padding-right:5%;
    }
    .searchButton {
        position: relative;
        left: -82%;
        top:  -20%;
        border: none;
        background: transparent;
        text-align: center;
        /*cursor: pointer;*/
        font-size: 18px;
    }
</style>