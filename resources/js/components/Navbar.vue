<template>
  <nav class="navbar navbar-expand-lg navbar-light shadow fixed-top bg-light">
    <router-link class="navbar-brand" to="/" exact>Portreto</router-link>
    <div v-if="isUserLogged" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      Mon compte
      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
      </svg>
    </div>
    <div v-if="isUserLogged" class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <router-link class="nav-link" to="/dashboard" data-toggle="collapse" data-target="#navbarNav">TABLEAU DE BORD</router-link>
        </li>
        <li class="nav-item" @click="logout">
          <router-link class="nav-link" to="/" data-toggle="collapse" data-target="#navbarNav">
            <div>DÉCONNEXION</div>
          </router-link>
        </li>
      </ul>
    </div>
  </nav>  
</template>

<script>
import store from '../store.js';

export default {
  data() {
    return {

    }
  },
  store,
  methods: {
    logout() {
      axios.post('/api/logout').then(() => {
        store.commit('CLEAR_USER');
      }).catch(error => {
        console.log('Echec de la déconnexion : ' + error);
      })
    }
  },
  computed: {
    isUserLogged() {
      return store.getters.isUserLogged;
    }
  }
}

</script>

<style scoped>
.navbar-brand {
  font-size: 1.5em;
}

.navbar-brand:hover {
  color: #219e89;
}

.nav-link {
  cursor: pointer;
  font-size: 1.1em;
  color: #f8fafc;
  text-decoration: none;
  float: right;
  margin-right: 16px;
}

.nav-link:after {
  content: '';
  position: relative;
  width: 0; 
  height: 10px;
  display: block;
  margin-top: -12px;
  z-index: -1;
  background-image: linear-gradient(to right bottom, #4eb888, #37ab8a, #219e8a, #0b9187, #008383);
  opacity: 0.5;
  transition: width .2s ease;
}

.nav-link:hover:after {
  width: 90%;
  left: 0;
}

.navbar-toggler {
  border: none;
}

</style>