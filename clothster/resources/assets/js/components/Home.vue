<template>
    <div>
        <top></top>
        <slide-show></slide-show>
    </div>
</template>

<script>
    import Vue from 'vue';

    Vue.component('Top', require('./Top.vue'));
    Vue.component('SlideShow', require('./SlideShow.vue'));
    export default {}
</script>