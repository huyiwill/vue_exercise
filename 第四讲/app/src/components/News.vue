<template>
  <div id="app">
    <div id="news">
      {{mm}}
    </div>
    <div id="b">
      <input type="button" value="点击显示隐藏" v-on:click="show=!show"/>
      <transition-group enter-active-class="zoomInLeft" leave-active-class="zoomOutRight">
        <p v-show="show" class="animated" :key="1"></p>
        <p v-show="show" class="animated" :key="2"></p>
      </transition-group>
    </div>
  </div>

</template>
<style>
  p{
    width:300px;
    height:300px;
    background: red;
  }

</style>
<script>
  export default {
    name: "News",
    data(){
      return {
        mm  : '3asdfasd',
        show: false
      }
    },
  }

</script>

<style scoped>

</style>
