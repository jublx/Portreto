<template>
  <div>
    
  </div>
</template>

<script>
import store from '../store.js'; 

export default {
  store,
  data(){
    return {
      modifyingInfos: {}
    }
  },
  computed: {
    isUserLogged() {
      return store.getters.isUserLogged;
    },
    user() {
      return store.getters.user;
    },
    user_infos() {
      return store.getters.user_infos;
    }
  },
  created(){
    this.modifyingInfos = store.getters.user_infos;
  }
}
</script>

<style scoped>

</style>