<template>
  <img alt="Vue logo" src="./assets/logo.png">
  <HelloWorld msg="Welcome to Your Vue.js App"/>
  <PaketList/>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'
import PaketList from './components/PaketList.vue';

export default {
  name: 'App',
  components: {
    HelloWorld,
    PaketList,
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
