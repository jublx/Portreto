<template>
  <div class="row justify-content-center">
    <div class="card algin-content-center shadow w-lg-50 mt-5" style="margin:auto;">
      <div class="card-img-top bg-custom shadow-lg w-100" style="background-color: ">
        <div class="d-flex flex-column text-center">
          <img :src="'/images/avatars/'+user_infos.avatar" alt="avatar" class="rounded-circle mt-4" width="150">
        </div>
      </div>
      <div class="card-body px-5 text-center">
        <h2 class="card-title mt-3">Bienvenue sur <span>Portreto</span>, {{ user.first_name }} !</h2>
        <div class="row justify-content-center">
          <router-link to="/Dashboard" class="btn btn-primary my-4">Tableau de bord</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from '../store.js';

export default {
  store,
  computed: {
    user() {
      return store.getters.user;
    },
    user_infos() {
      return store.getters.user_infos;
    }
  },
}
</script>

<style scoped>
.bg-custom {
  width: 18rem;
  background-image: linear-gradient(to right bottom, #4eb888, #37ab8a, #219e8a, #0b9187, #008383);
  color: #f8fafc;
}

h2 {
  font-family: Roboto, sans-serif;
  font-weight: 80;
  font-size: 1.8em;
  line-height: 70px;
}

.btn {
  font-size: 1.2em;
}

img {
  margin: 40px auto;
}

</style>