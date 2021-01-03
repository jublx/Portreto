<template>
    <div class="page container-fluid px-5">
      <div class="row">
        <div class="col-xl">
          <div class="row">
            <h1><span>Portreto</span>, la plateforme qui regroupe les informations de contact qui <span>vous</span> intéressent.</h1>
          </div>
          <div class="row d-none d-xl-block">
            <image-csv class="img1"></image-csv>
          </div>
        </div>
        <div class="col-xl px-xl-5">
          <transition enter-active-class="flip-in-hor-top" leave-active-class="flip-out-hor-top" mode="out-in">
            <connection-formulary v-if="!isUserLogged"></connection-formulary>
            <index-profile v-else></index-profile>
          </transition>
        </div>
      </div>
      <div class="row d-lg-block d-xl-none">
        <image-csv class="img2"></image-csv>
      </div>
    </div>
</template>

<script>
import store from '../store.js';
import Connection from './Connection';
import IndexProfile from './IndexProfile';
import ImageCSV from './ImageCSV';

export default {
  components: {
    "connection-formulary": Connection,
    "index-profile": IndexProfile,
    "image-csv": ImageCSV
  },
  computed: {
    isUserLogged() {
      return store.getters.isUserLogged;
    }
  }
}
</script>

<style scoped>
h1 {
  margin-left: 8%;
}

.img1 {
  max-width: 60%;
  margin: auto;
}

.img2 {
  width: 70%;
  margin: 6vh auto 0;
}
</style>