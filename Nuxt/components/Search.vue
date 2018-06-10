<template>
    <div class="search" style="float:left;display: inline-block;">
        <input class="searchTerm" type="text" placeholder='&#128269;' style="font-weight: bold;"/>
        <!--<button type="submit" class="searchButton">-->
            <!--<i class="fa fa-search">&#128269;</i>-->
        <!--</button>-->
    </div>
</template>

<script>
    export default{
        name: 'search'
    }
</script>

<style scoped>
    .search {
        /*width: 100%;*/
        position: relative
    }
    .search ::placeholder{
        direction: ltr;
    }
    .searchTerm {
        float: left;
        width: 120%;
        border: 2px solid silver;
        padding: 5px;
        height: 25px;
        border-radius: 15px;
        outline: none;
        color: #9DBFAF;
    }

    .searchButton {
        position: absolute;
        right: 90%;
        width: 40px;
        height: 36px;
        border: 2px solid silver;
        background: white;
        text-align: center;
        color: #fff;
        border-radius: 7px;
        border-right: none;
        cursor: pointer;
        font-size: 20px;
    }
</style>