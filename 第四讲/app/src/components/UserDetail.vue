<template>
  <div>
    我是用户详细信息
    <ul>
      <li>用户:{{$route.params.name}}</li>
      <li>年龄:{{$route.params.age}}</li>
      <li>用户:{{msg}}</li>
    </ul>
  </div>
</template>

<script>
  export default {
    name   : "UserDetail",
    created: function(){
      var names = this.$route.params.name;
    },
    data(){
      return {
        msg: 'asdf'
      }
    },
  }
</script>

<style scoped>

</style>
