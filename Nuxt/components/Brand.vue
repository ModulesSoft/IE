<template>
    <div class="brand" align="center">
        <search></search>
        <div id="brand_name">
            <a href="#" class="brand_word">Clothster</a>
        </div>
        <div class="login_register">
            <div class="btnborder">
                <a @click="toggle" class="abtn" >login</a>
            </div>
            <modal v-if="this.showModal" @close="toggle"></modal>

            <div class="btnborder">
                <a href="#" class="abtn">register</a>
            </div>
        </div>
    </div>
</template>

<script>
import search from "~/components/Search.vue";
import modal from "~/components/Modal.vue";
export default {
  components: {
    search,
    modal
  },
  data() {
    return {
      showModal: false
    };
  },
  methods: {
    toggle: function() {
      this.showModal = !this.showModal;
    }
  }
};

// start app
// new Vue({
//   el: '#app',
//   data: {
//     showModal: false
//   }
// })
</script>

<style scoped>
.brand_name {
  display: inline-block;
  margin-top: -20px;
}
.brand_word {
  text-decoration: none;
  color: silver;
  font-size: 30px;
}
.login_register {
  float: right;
  margin-top: -50px;
  display: inline-block;
}
.btnborder {
  display: inline-block;
  border-style: solid;
  border-radius: 20px;
  border-color: silver;
  background-color: silver;
  padding: 5px 30px 5px 30px;
}
.abtn {
  text-decoration: none;
  color: white;
  cursor: pointer;
}
</style>