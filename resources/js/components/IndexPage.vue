<template>
    <div class="page container-fluid px-5">
      <div class="row">
        <div class="col-xl">
          <div class="row">
            <h1><span>Portreto</span>, la plateforme qui regroupe les informations de contact qui <span>vous</span> intéressent.</h1>
          </div>
          <div class="row">
            <img src="../../images/profile.png" class="d-none ">
          </div>
        </div>
        <div class="col-xl px-xl-5">
          <transition enter-active-class="flip-in-hor-top" leave-active-class="flip-out-hor-top" mode="out-in">
            <connection-formulary v-if="!isUserLogged"></connection-formulary>
            <index-profile v-else></index-profile>
          </transition>
        </div>
      </div>
    </div>
</template>

<script>
import store from '../store.js';
import ProfilePage from './ProfilePage'
import Connection from './Connection';

export default {
  components: {
    "profile-page": ProfilePage,
    "connection-formulary": Connection
  },
  computed: {
    isUserLogged() {
      return store.getters.isUserLogged;
    }
  }
}
</script>

<style>
h1 {
  font-family: Roboto, sans-serif;
  font-weight: 80;
  font-size: 3em;
  line-height: 70px;
}

img {
  max-width: 50%;
  margin: 6vh auto 0;
}
</style>