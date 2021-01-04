<template>
  <div>
    <input type="text" v-model="search" placeholder="Rechercher" class="form-control mb-2 shadow"/>    
    <div id="accordion" class="mt-3 shadow">
      <div v-if="currentInfos.length != 0">
      <div class="card contact-list-item"  v-for="(contact, index) in user_contacts_filtered" :key="contact.user_id">
        <div class="card-header h-50" :id="'heading'+index" data-toggle="collapse" :data-target="'#collapse'+index">
          <div class="row justify-content-center">
            <div class="col-3 align-self-center">
              <img :src="'/images/avatars/'+contact.avatar" alt="avatar" class="rounded-circle my-1 ml-2" width="50">
            </div>
            <div class="col-9 mt-3">
                <h4>{{ contact.user.first_name }} {{ contact.user.name }}</h4>
            </div>
            <div class="overlay mt-3">
              <span class="text-danger" @click="contactToDelete = contact.user_id" data-toggle="modal" data-target="#validationModalMobile"><i class="fas fa-trash-alt"></i></span>
            </div>
          </div>
        </div>
        <div :id="'collapse'+index" class="collapse" :aria-labelledby="'heading'+index" data-parent="#accordion">
          <div class="card-body">
            <div class="card shadow bg-light mt-2">
              <div class="card-body">
                <div class="row justify-content-center mt-1">
                  <div class="text-center">
                    <p class="card-p">{{ contact.job }}</p>
                    <p class="card-p">{{ contact.adresse }}</p>
                    <p class="card-p">code ami : {{ contact.friend_code }}</p>
                  </div>
                </div>
                <div class="row justify-content-center mt-5">
                  <div class="col-5 d-inline-flex">
                    <div class="col-sm-3">
                      <i class="fab fa-linkedin-in"></i>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ contact.linkedin }}
                    </div>
                  </div>
                  <div class="col-7 d-inline-flex">
                    <div class="col-sm-3">
                      <i class="fab fa-twitter"></i>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ contact.twitter }}
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-5 d-inline-flex">
                    <div class="col-sm-3">
                      <i class="fab fa-instagram"></i>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ contact.instagram }}
                    </div>
                  </div>
                  <div class="col-7 d-inline-flex">
                    <div class="col-sm-3">
                      <i class="fab fa-facebook-square"></i>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ contact.facebook }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card shadow bg-light mt-2">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <h5 class="mt-1">Email</h5>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ contact.contact_email }}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h5 class="mt-1">Tél.</h5>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ contact.phone_number }}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h5 class="mt-1">Diplômes</h5>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ contact.diploma }}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h5 class="mt-1">Bio.</h5>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ contact.biography }}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h5 class="mt-1">Centres d'intérêts</h5>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ contact.interests }}
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div v-else class="row justify-content-center">
      <small class="form-error mt-5 text-center">Vous ne possédez pour le moment aucun contact.</small>            
    </div>
    </div> 
    <div class="modal fade" id="validationModalMobile" tabindex="-1" role="dialog" aria-labelledby="validationModalMobileLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="validationModalMobileLabel">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="contactToDelete = null">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Voulez-vous vraiment supprimer ce contact ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="contactToDelete = null" data-dismiss="modal">Non</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="removeContact(contactToDelete)">Oui</button>
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
  data() {
    return {
      currentContact: 0,
      search: "",
      contactToDelete: null
    }
  },
  methods: {
    removeContact(contact_id) {
      axios.get('/sanctum/csrf-cookie').then(() => {
        axios.post('/api/remove_contact', {contact_id}).then(() => {
          console.log("Le contact a bien été supprimé.");
          this.$root.getUserContacts();
        }).catch(error => {
          console.log("Erreur lors de la suppression du contact : "+error);
        })
      })
      this.contactToDelete = null;
    }
  },
  computed: {
    user_contacts() {
      return store.getters.user_contacts;
    },
    currentInfos() {
      if(this.user_contacts.length > 0) {
        return this.user_contacts_filtered[this.currentContact];
      }
      return [];
    },
    user_contacts_filtered() {
      let filtered_list = store.getters.user_contacts.filter((contact) => {
        let contactFullName = contact.user.first_name+" "+contact.user.name;
        return contactFullName.toLowerCase().includes(this.search.toLowerCase());
      });
      if(filtered_list.length == 0) {
        return this.user_contacts;
      }
      this.currentContact = 0;
      return filtered_list;
    }
  }
}
</script>

<style scoped>
.contact-list-item {
  cursor: pointer;
}

.contact-list-item .overlay {
  cursor: pointer;
  position: absolute;
  top: 14px;
  right: 6%;
  opacity: 0;
  transition: opacity 0.2s ease-in-out;
}

.contact-list-item .overlay span {
  padding: 4px;
}

.contact-list-item:hover .overlay{
  opacity: 0.8;
}
</style>