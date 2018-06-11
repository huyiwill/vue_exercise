<template>
  <div id="home">
    <h3>我是主页</h3>
    <input type="text" v-model="show"/>
    <transition-group enter-active-class="zoomInLeft" leave-active-class="zoomOutRight">
      <p v-show="show" v-for="(val,index) in lists" :key="index">
        {{val}}
      </p>
    </transition-group>
  </div>
</template>

<script>
  export default {
    name    : "Home",
    data(){
      return {
        show: '',
        list: ['apple', 'banana', 'orange', 'pear']
      }
    },
    computed: {
      lists: function(){
        var arr = [];
        this.list.forEach(function(val){
          if(val.indexOf(this.show) != -1){
            arr.push(val);
          }
        }.bind(this));
        return arr;
      }
    },
  }
</script>

<style scoped>

</style>
