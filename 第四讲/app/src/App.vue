<template>
  <div id="app">
    <strong>{{msg}}</strong>
    <br>
    <router-link to="/news">新闻</router-link>
    <br>
    <router-link to="/hello">哈罗</router-link>
    <router-view></router-view>
  </div>
</template>

<script>
  export default {
    data(){
      return {
        msg: 333
      }
    },
  }
</script>

<style>
  #app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
  }
</style>
