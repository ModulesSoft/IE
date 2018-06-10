<template>
  <section>
      <slideshow></slideshow>
      <div class="category-images">
        <a href="#">
          <img src="http://thefashionformen.com/wp-content/uploads/2015/01/stylish-clothes-for-men.jpg">
          <div class="image-text">
            <span>
            مردانه
            </span>
          </div>
        </a>
        <a href="#">
          <img src="http://weareladies.net/wp-content/uploads/2015/01/Women-best-clothes-2015.jpeg">
          <div class="image-text">
            <span>
            زنانه
            </span>
          </div>
        </a>
        <a href="#">
          <img src="https://luxuryactivist.com/wp-content/uploads/Children-fashion-clothes.jpg">
          <div class="image-text">
            <span>
            بچگانه
            </span>
          </div>
        </a>
      </div>
  </section>
</template>

<script>
import slideshow from '@/components/SlideShow.vue';
export default {
  components: {
    slideshow,
  }
}
</script>

<style>
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
</style>
