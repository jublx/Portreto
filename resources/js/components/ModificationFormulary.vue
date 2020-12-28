<template>
  <div>
    <button @click="getCurrentInfos()" type="button" class="btn btn-primary btn-custom" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">modifier</button>
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modification de vos informations</h5>
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
                      <input type="text" class="form-control" id="email" v-model="modifiedInfos.contact_email">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Nationalité:</label>
                      <input type="text" class="form-control" id="nationalite" v-model="modifiedInfos.nationality">
                    </div>
                    
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Tél:</label>
                      <input type="text" class="form-control" id="tel" v-model="modifiedInfos.phone_number">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Diplômes:</label>
                      <input type="text" class="form-control" id="diplomes" v-model="modifiedInfos.diploma">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Job:</label>
                      <input type="text" class="form-control" id="job" v-model="modifiedInfos.job">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Bio:</label>
                      <textarea class="form-control" id="bio" v-model="modifiedInfos.biography"></textarea>
                    </div>
                </div>
              </div>
              <div class="col">
                <div class="modal-body">
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Adresse:</label>
                      <input type="text" class="form-control" id="adresse" v-model="modifiedInfos.adresse">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Linkedin:</label>
                      <input type="text" class="form-control" id="linkedin" v-model="modifiedInfos.linkedin">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Instagram:</label>
                      <input type="text" class="form-control" id="instagram" v-model="modifiedInfos.instagram">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Twitter:</label>
                      <input type="text" class="form-control" id="twitter" v-model="modifiedInfos.twitter">
                    </div>

                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Facebook:</label>
                      <input type="text" class="form-control" id="facebook" v-model="modifiedInfos.facebook">
                    </div>

                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Centres d'interêts:</label>
                      <textarea class="form-control" id="interets" v-model="modifiedInfos.interests"></textarea>
                    </div>
                    
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="modal-footer">
                  
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" @click="save()">Enregistrer</button>
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
      modifiedInfos: {},
      display: false,
      success: false,
      errors: []
    }
  },
  methods: {
    getCurrentInfos() {
      this.modifiedInfos = JSON.parse(JSON.stringify(store.getters.user_infos));
    },
    save() {
      axios.get('/sanctum/csrf-cookie').then(() => {
        axios.post('/api/update_user_infos', this.modifiedInfos).then(() => {
          this.success = true;
          this.$root.getUserInfos();
          $('#modal').modal("toggle");
        }).catch(error => {
          this.errors = error.response.data.errors;
        })
      })
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
  }
}



</script>

<style scoped>

.btn-custom {
  float: right;
  margin-bottom: 6px;
}
</style>