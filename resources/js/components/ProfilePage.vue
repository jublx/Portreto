<template>    
  <div v-if="isUserLogged" class="container page">
    <div class="row p-3">
      <div class="col-md-5">
        <div class="row">
          <div class="card bg-custom shadow">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                <div class="mt-3">
                  <h4>{{ user.name }}</h4>
                  <p class="text-secondary mb-1">{{ user_infos.job }}</p>
                  <p class="text-muted font-size-sm">{{ user_infos.adresse }}</p>
                  <p class="text-muted font-size-sm">code ami : {{ user_infos.friend_code }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7 card shadow bg-light">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-3">
              <h5 class="mb-0">Email</h5>
            </div>
            <div class="col-sm-9 text-secondary">
              {{ user_infos.contact_email }}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h5 class="mb-0">Bio</h5>
            </div>
            <div class="col-sm-9 text-secondary">
              {{ user_infos.biography }}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h5 class="mb-0">Tél.</h5>
            </div>
            <div class="col-sm-9 text-secondary">
              {{ user_infos.phone_number }}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h5 class="mb-0">Diplômes</h5>
            </div>
            <div class="col-sm-9 text-secondary">
              {{ user_infos.diploma }}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h5 class="mb-0">Centres d'intérêts</h5>
            </div>
            <div class="col-sm-9 text-secondary">
              {{ user_infos.interests }}
            </div>
          </div>
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
    isUserLogged() {
      return store.getters.isUserLogged;
    },
    user() {
      return store.getters.user;
    },
    user_infos() {
      return store.getters.user_infos;
    }
  }
}
</script>

<style scoped>
div {
  text-align: left;
}

h4, p {
  text-align: center;
}

p {
  font-size: 1.1em;
}

.bg-custom {
  background-image: linear-gradient(to right bottom, #4eb888, #37ab8a, #219e8a, #0b9187, #008383);
  color: #f8fafc;
}

.card {
  width: 94%;
  font-size: 1.2em;
}

</style>