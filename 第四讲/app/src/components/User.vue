<template>
  <div>
    <h3>用户信息</h3>
    <ul>
      <li>
        <router-link to="/user/name/huyi/age/33">用户1</router-link>
      </li>
      <li>
        <router-link to="/user/name/strive/age/10">Strive</router-link>
      </li>
      <li>
        <router-link to="/user/name/blue/age/80">Blue</router-link>
      </li>
      <li>
        <router-link to="/user/name/eric/age/70">Eric</router-link>
      </li>
    </ul>
<div>
    <router-view></router-view>
</div>
  </div>

</template>

<script>
  export default {
    name: "User"
  }
</script>

<style scoped>

</style>
