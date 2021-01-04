<template>
  <div> <!-- empêche les erreurs liées à la réactivité du composant -->
    <div class="row">
      <div class="col-3 p-0">
        <input type="text" v-model="search" placeholder="Rechercher" class="form-control mb-2 shadow"/>
        <ul class="list-group shadow">
          <li class="list-group-item contact-list-item" v-for="(contact, index) in user_contacts_filtered" :key="contact.user_id" @click="currentContact = index" :class="index == currentContact ? 'current-contact':''">
            {{ contact.user.first_name }} {{ contact.user.name }}
            <div class="overlay">
              <span class="text-danger" @click="contactToDelete = contact.user_id" data-toggle="modal" data-target="#validationModal"><i class="fas fa-trash-alt"></i></span>
            </div>
          </li>
        </ul>
      </div>
      <div class="col-9" v-if="currentInfos.length != 0">
        <div class="row">
          <div class="col-6 pl-4 pr-2">
            <div class="card shadow bg-custom h-100">
              <div class="card-body">
                <div class="text-center">
                  <img :src="'/images/avatars/'+currentInfos.avatar" alt="avatar" class="rounded-circle mt-4" width="150">
                  <div class="mt-3">
                    <h4>{{ currentInfos.user.first_name }} {{ currentInfos.user.name }}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card col-6 shadow bg-light">
            <div class="card-body">
              <div class="row justify-content-center mt-1">
                <div class="text-center">
                  <p class="card-p">{{ currentInfos.job }}</p>
                  <p class="card-p">{{ currentInfos.adresse }}</p>
                  <p class="card-p">code ami : {{ currentInfos.friend_code }}</p>
                </div>
              </div>
              <div class="row justify-content-center mt-5">
                <div class="col-5 d-inline-flex">
                  <div class="col-sm-3">
                    <i class="fab fa-linkedin-in"></i>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ currentInfos.linkedin }}
                  </div>
                </div>
                <div class="col-7 d-inline-flex">
                  <div class="col-sm-3">
                    <i class="fab fa-twitter"></i>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ currentInfos.twitter }}
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
                    {{ currentInfos.instagram }}
                  </div>
                </div>
                <div class="col-7 d-inline-flex">
                  <div class="col-sm-3">
                    <h5 class="mb-0">
                      <i class="fab fa-facebook-square"></i>
                    </h5>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ currentInfos.facebook }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col pl-4 p-0">
            <div class="card shadow bg-light mt-2">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <h5 class="mt-1">Email</h5>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ currentInfos.contact_email }}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h5 class="mt-1">Tél.</h5>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ currentInfos.phone_number }}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h5 class="mt-1">Diplômes</h5>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ currentInfos.diploma }}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h5 class="mt-1">Bio.</h5>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ currentInfos.biography }}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h5 class="mt-1">Centres d'intérêts</h5>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ currentInfos.interests }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="row col-9 justify-content-center">
        <p class="form-error mt-5">Vous ne possédez pour le moment aucun contact.</p>            
      </div>
    </div> 
    <div class="modal fade" id="validationModal" tabindex="-1" role="dialog" aria-labelledby="validationModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="validationModalLabel">Confirmation</h5>
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
.list-group {
  height: 65.2vh;
  overflow-y: scroll;
  -webkit-overflow-scrolling: touch;
}

.list-group-item {
  cursor: pointer;
  background-color: #f8fafc;
  font-size: 1.2em;
  transition: background-color 0.2s;
}

.list-group-item:hover {
  background-color: #e9e9e9;
}

.bg-custom {
  background-image: linear-gradient(to right bottom, #4eb888, #37ab8a, #219e8a, #0b9187, #008383);
  color: #f8fafc;
}

.card-p {
  font-size: 1.4em;
  padding: 0;
  margin-top: 10px;
}

.text-secondary {
  font-size: 1.3em;
}

.current-contact::before {
  content: "→";
  margin-right: 6%;
  color: #008383;
}

.contact-list-item .overlay {
  cursor: pointer;
  position: absolute;
  top: 14px;
  right: 6%;
  opacity: 0;
  transition: opacity 200ms ease-in-out;
  transition: right 0.2s ease-in-out;
}

.contact-list-item .overlay span {
  padding: 4px;
}

.contact-list-item:hover .overlay{
  opacity: 0.8;
}

</style>