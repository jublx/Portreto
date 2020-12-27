<template>
  <div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">modifier</button>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modification</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Email:</label>
                <input type="text" class="form-control" id="email" v-model="user_infos.contact_email">
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Bio:</label>
                <input type="text" class="form-control" id="recipient-name" v-model="user_infos.biography">
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Tél:</label>
                <input type="text" class="form-control" id="recipient-name" v-model="user_infos.phone_number">
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Diplômes:</label>
                <input type="text" class="form-control" id="recipient-name" v-model="user_infos.diploma">
              </div>

              <div class="form-group">
                <label for="message-text" class="col-form-label">Centres d'interêts:</label>
                <textarea class="form-control" id="message-text" v-model="user_infos.interests"></textarea>
              </div>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary">Enregistrer</button>
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