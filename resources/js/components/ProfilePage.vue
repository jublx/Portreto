<template>    
  <div v-if="isUserLogged" class="container page">
    <div class="row">
      <div class="col-8">
        <h1>Tableau de Bord</h1>
      </div>
      <modification-formulary class="col-4 align-self-end"></modification-formulary>
    </div>
    <div class="row">
      <div class="col-md-5">
        <div class="card bg-custom shadow">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
              <div class="mt-3">
                <h4>{{ user.name }}</h4>
                <p class="text-muted">{{ user_infos.job }}</p>
                <p class="text-muted font-size-sm">{{ user_infos.adresse }}</p>
                <p class="text-muted font-size-sm">code ami : {{ user_infos.friend_code }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="card shadow bg-light">
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
        <div class="card mt-md-4 shadow bg-light">
          <div class="card-body">
            <form class="row">
              <div class="form-inline mx-sm-2 mb-2">
                <label class="col-lg-3 p-0">Ajouter un contact</label>
                <div class="col-lg-6 justify-content-center d-inline-flex p-0 mt-2">
                  <input type="text" class="form-control mx-2" id="part1" maxlength="3">
                  <label>-</label>
                  <input type="text" class="form-control mx-2" id="part2" maxlength="3">
                  <label>-</label>
                  <input type="text" class="form-control mx-2" id="part3" maxlength="3">
                </div>
                <div class="col-lg-3 justify-content-center d-flex p-0 mt-4 mt-lg-2">
                  <button type="submit" class="btn btn-primary" @click.prevent>Ajouter contact</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5">

      </div>
      <div class="col-md-7">
        <contacts-browser></contacts-browser>
      </div>
    </div>
  </div>
</template>

<script>
import store from '../store.js';
import ContactBrowser from './ContactsBrowser.vue';
import ModificationFormulary from './ModificationFormulary.vue';

export default {
  store,
  data(){
    return {
      addFriendCode: {
        part1: "",
        part2: "",
        part3: ""
      }
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
  components: {
    'contacts-browser': ContactBrowser,
    'modification-formulary': ModificationFormulary
  }
}
</script>

<style scoped>
h1 {
  margin: 10px;
}

h4, p {
  text-align: center;
}

p {
  font-size: 1.1em;
}

.page {
  margin-top: 100px;
}

.bg-custom {
  background-image: linear-gradient(to right bottom, #4eb888, #37ab8a, #219e8a, #0b9187, #008383);
  color: #f8fafc;
}

.card {
  font-size: 1.2em;
}

.btn-modal {
  margin-bottom: -30px;
}

.text-muted {
  margin: 0;
}

.form-control {
  width: 22%;
  text-align: center;
}

</style>