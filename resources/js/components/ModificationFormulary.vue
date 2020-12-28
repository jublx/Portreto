<template>
  <div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">modifier</button>

    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modification</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form >
            <div class="row">
              <div class="col">
                <div class="modal-body">
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Email:</label>
                      <input type="text" class="form-control" id="email" v-model="user_infos.contact_email">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Nationalité:</label>
                      <input type="text" class="form-control" id="nationalite" v-model="user_infos.nationality">
                    </div>
                    
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Tél:</label>
                      <input type="text" class="form-control" id="tel" v-model="user_infos.phone_number">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Diplômes:</label>
                      <input type="text" class="form-control" id="diplomes" v-model="user_infos.diploma">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Job:</label>
                      <input type="text" class="form-control" id="job" v-model="user_infos.job">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Bio:</label>
                      <textarea class="form-control" id="bio" v-model="user_infos.biography"></textarea>
                    </div>
                </div>
              </div>
              <div class="col">
                <div class="modal-body">

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Adresse:</label>
                      <input type="text" class="form-control" id="adresse" v-model="user_infos.adresse">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Linkedin:</label>
                      <input type="text" class="form-control" id="linkedin" v-model="user_infos.linkedin">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Instagram:</label>
                      <input type="text" class="form-control" id="instagram" v-model="user_infos.instagram">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Twitter:</label>
                      <input type="text" class="form-control" id="twitter" v-model="user_infos.twitter">
                    </div>

                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Facebook:</label>
                      <input type="text" class="form-control" id="facebook" v-model="user_infos.facebook">
                    </div>

                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Centres d'interêts:</label>
                      <textarea class="form-control" id="interets" v-model="user_infos.interests"></textarea>
                    </div>
                    
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                  <button type="button" class="btn btn-primary">Enregistrer</button>
                </div>
              </div>
            </div>
          </form>
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