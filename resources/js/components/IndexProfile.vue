<template>
    <div class="card bg-custom shadow">
        <div class="card-body" style="background-color: ">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                <div class="mt-3">
                    <h4>{{ user.name }}</h4>
                    <p class="text-muted">{{ user_infos.job }}</p>
                    <p class="text-muted font-size-sm">{{ user_infos.adresse }}</p>
                    <p class="text-muted font-size-sm">code ami : {{ user_infos.friend_code }}</p>
                </div>
                <router-link class="nav-link" to="/profile" data-toggle="collapse" data-target="#navbarNav">TABLEAU DE BORD</router-link>
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
  background-image: linear-gradient(to right bottom, #4eb888, #37ab8a, #219e8a, #0b9187, #008383);
  color: #f8fafc;
}
</style>