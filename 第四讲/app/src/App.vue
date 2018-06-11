<template>
  <div id="app">
    <input type="button" value="添加一个路由" v-on:click="push"/>
    <input type="button" value="替换一个路由" v-on:click="replace"/>
    <strong>{{msg}}</strong>
    <br>
    <router-link to="/news">新闻</router-link>
    <br>
    <router-link to="/home">主页</router-link>
    <br>
    <router-link to="/user">用户</router-link>
    <br>
    <router-link to="/element">ElementUI</router-link>
    <transition enter-active-class="animated bounceInLeft" leave-active-class="animated bounceOutRight">
      <router-view></router-view>
    </transition>
  </div>
</template>

<script>
  import router from './router'
  $(function () {
    //alert(123);
  });

  export default {
    data(){
      return {
        msg: 333
      }
    },
    methods: {
      push   : function(){
        router.push({path: 'home'});
      },
      replace: function(){
        router.replace({path: 'user'});
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
