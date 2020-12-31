<template>
  <div>
    <div class="card bg-custom algin-content-center shadow" style="margin:auto;">
      <div class="card-body" style="background-color: ">
        <div class="d-flex flex-column text-center">
          <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
          <div class="mt-3">
            <h4 style="margin-top:1em; margin-bottom:1em;">{{ user.first_name }} {{ user.name }}</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-custom3 algin-content-center shadow" style="margin:auto; margin-top:3em; text-align: center;">
      <router-link to="/Dashboard">
        <button type="button" class="btn btn-secondary2" data-dismiss="modal" style="margin: auto;">
          <div class="card-body">
            <div class="d-flex flex-column text-center">
              <div class="mt-3">
                <h1 style="font-size: 1.7em;">Bienvenue sur <span>Portreto</span></h1>
                <h2 style="font-size: 0.75em;"><span>CLIQUEZ ICI POUR ACCEDER AU TABLEAU DE BORD</span></h2>
              </div>
            </div>
          </div>
        </button>
      </router-link>
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

.bg-custom2 {
  width: 18rem;
  color: #1a1a1a;
}

.bg-custom3 {
  width: 22rem;
  color: #1a1a1a;
}

.btn-secondary:hover {
    color: #fff;
    background-color: #d6d6d6;
    border-color: #545b62;
}
</style>