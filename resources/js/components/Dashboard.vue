<template>    
  <div v-if="isUserLogged" class="container page">
    <transition enter-active-class="flip-in-hor-top" leave-active-class="flip-out-hor-top" mode="out-in">
      <div key=1 v-if="contactBrowser">
        <div class="row">
          <div class="col-8 p-0">
            <h1>Mes Contacts</h1>
          </div>
          <div class="col-4 text-right">
            <i class="fas fa-times" @click="contactBrowser = !contactBrowser"></i>
          </div>
        </div>
        <contacts-browser v-if="contactBrowser" class="d-none d-lg-block"></contacts-browser>
        <contact-browser-mobile v-if="contactBrowser" class="d-md-block d-lg-none"></contact-browser-mobile>
      </div>    
      <div key=2 v-else>
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
                  <small v-if="imageUploadErrors.avatar" class="form-error"><i class="fas fa-times-circle"></i> {{ imageUploadErrors.avatar[0] }}</small>            
                  <div class="image-upload" :class="imageUploadErrors.avatar ? 'shake-horizontal':''">
                    <label for="file-input" >
                      <img :src="'/images/avatars/'+user_infos.avatar" alt="avatar" class="rounded-circle mt-4" width="150">
                      <div class="overlay">
                        <span>modifier</span>
                      </div>
                    </label>
                    <input id="file-input" type="file" @change="uploadAvatar" accept=".png, .jpg, .jpeg"/>
                  </div>
                  <div class="mt-3">
                    <h4>{{ user.first_name }} {{ user.name }}</h4>
                    <p class="text-muted">{{ user_infos.job }}</p>
                    <p class="text-muted adresse">{{ user_infos.adresse }}</p>
                    <p class="text-muted">code ami : {{ user_infos.friend_code }}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card mt-md-4 mt-2 shadow bg-light">
              <div class="card-body">
                <div class="row">
                  <div class="col-5 d-inline-flex">
                    <div class="col-sm-3">
                      <i class="fab fa-linkedin-in"></i>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ user_infos.linkedin }}
                    </div>
                  </div>
                  <div class="col-7 d-inline-flex">
                    <div class="col-sm-3">
                      <i class="fab fa-twitter"></i>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ user_infos.twitter }}
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
                      {{ user_infos.instagram }}
                    </div>
                  </div>
                  <div class="col-7 d-inline-flex">
                    <div class="col-sm-3">
                      <i class="fab fa-facebook-square"></i>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ user_infos.facebook }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-7 mt-md-0 mt-2">
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
                    <h5 class="mb-0">Bio.</h5>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ user_infos.biography }}
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
            <div class="card mt-md-4 mt-2 shadow bg-light">
              <div class="card-body">
                <form class="row">
                  <div class="form-inline mx-sm-2 mb-2">
                    <label class="col-lg-3 p-0 text-center">Ajouter un contact</label>
                    <div class="col-lg-6 justify-content-center d-inline-flex p-0 mt-2">
                      <input type="number" min="100" max="999" class="form-control mx-2" id="part1" v-model="addFriendCode.part1"/>
                      <label>-</label>
                      <input type="number" min="100" max="999" class="form-control mx-2" id="part2" v-model="addFriendCode.part2"/>
                      <label>-</label>
                      <input type="number" min="100" max="999" class="form-control mx-2" id="part3" v-model="addFriendCode.part3"/>
                    </div>
                    <div class="col-lg-3 justify-content-center d-flex p-0 mt-4 mt-lg-2">
                      <button type="submit" class="btn btn-primary" @click.prevent="addContact"><i class="fas fa-plus"></i> Ajouter contact</button>                  
                    </div>
                  </div>
                  <div class="row col ml-3">
                    <small v-if="addContactSuccess" class="form-sucess mr-5"><i class="fas fa-check-circle"></i> Le contact a bien été ajouté.</small>
                    <small v-if="addContactErrors.friend_code" class="form-sucess mr-5"><i class="fas fa-times-circle"></i> {{ addContactErrors.friend_code[0] }}</small>    
                  </div>
                </form>
              </div>
            </div>
            <div class="card shadow bg-light mt-md-4 mt-2">
              <div class="row justify-content-center py-4">
                <button class="btn btn-primary" @click="contactBrowser = !contactBrowser"><i class="fas fa-address-book"></i> Afficher mes contacts</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import store from '../store.js';
import ContactBrowser from './ContactsBrowser.vue';
import ContactBrowserMobile from './ContactBrowserMobile.vue';
import ModificationFormulary from './ModificationFormulary.vue';

export default {
  store,
  data(){
    return {
      addFriendCode: {
        part1: "",
        part2: "",
        part3: ""
      },
      contactBrowser: false,
      addContactSuccess: false,
      addContactErrors: [],
      imageUploadErrors: [],
    }
  },
  methods: {
    addContact() {
      let friend_code = this.addFriendCode.part1 + "-" + this.addFriendCode.part2 + "-" + this.addFriendCode.part3;
      this.addContactSuccess = false;
      this.addContactErrors = [];
      axios.get('/sanctum/csrf-cookie').then(() => {
        axios.post('/api/add_contact', {friend_code}).then(() => {
          console.log("Contact ajouté !");
          this.addContactSuccess = true;
          this.$root.getUserContacts(); // rafraîchit la liste des contacts
        }).catch(error => {
          this.addContactErrors = error.response.data.errors;
        })
      })
    },
    uploadAvatar() {
      var avatar = new FormData();
      var imagefile = document.querySelector('#file-input');
      avatar.append("avatar", imagefile.files[0]);
      var size = avatar.get("avatar").size / (1024 * 1024);
      if(size <= 5) {
        axios.get('/sanctum/csrf-cookie').then(() => {
          axios.post('/api/update_avatar', avatar, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }).then(() => {
            console.log('image uploadée');
            this.$root.getUserInfos();
          }).catch(error => {
            this.imageUploadErrors = error.response.data.errors;
            setTimeout(() => {
              this.imageUploadErrors = []; // supprime le message d'erreur au bout de 3,5s
            }, 3500);
          })
        })
      } else {
        this.imageUploadErrors = {avatar: ["La taille de l'image ne doit pas dépasser 5 Mo."]};
        setTimeout(() => {
          this.imageUploadErrors = []; // supprime le message d'erreur au bout de 3,5s
        }, 3500);
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
    },
    user_contacts() {
      return store.getters.user_contacts;
    }
  },
  components: {
    'contacts-browser': ContactBrowser,
    'contact-browser-mobile': ContactBrowserMobile,
    'modification-formulary': ModificationFormulary
  }
}
</script>

<style scoped>
.fa-times {
  cursor: pointer;
  font-size: 1.8em;
  margin-top: 42px;
}

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

.image-upload{
  position:relative;
  display:inline-block;
}

.image-upload .overlay{
  cursor: pointer;
  position:absolute;
  top:14px;
  left:0;
  width:100%;
  height:100%;
  opacity:0;
  transition:opacity 200ms ease-in-out;
}

.image-upload:hover .overlay{
  opacity: 1;
}

.image-upload:hover img {
  filter: brightness(50%);
}

.overlay span {
  position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
  color:#fff;
}

.image-upload>input {
  display: none;
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

.form-error {

}

.adresse {
  font-size: 0.9em;
}

.flip-out-hor-top {
	-webkit-animation: flip-out-hor-top 0.45s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
	        animation: flip-out-hor-top 0.45s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
}

@-webkit-keyframes flip-out-hor-top {
  0% {
    -webkit-transform: rotateX(0);
            transform: rotateX(0);
    opacity: 1;
  }
  100% {
    -webkit-transform: rotateX(70deg);
            transform: rotateX(70deg);
    opacity: 0;
  }
}
@keyframes flip-out-hor-top {
  0% {
    -webkit-transform: rotateX(0);
            transform: rotateX(0);
    opacity: 1;
  }
  100% {
    -webkit-transform: rotateX(70deg);
            transform: rotateX(70deg);
    opacity: 0;
  }
}

.flip-in-hor-top {
	-webkit-animation: flip-in-hor-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
	        animation: flip-in-hor-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
}

@-webkit-keyframes flip-in-hor-top {
  0% {
    -webkit-transform: rotateX(-80deg);
            transform: rotateX(-80deg);
    opacity: 0;
  }
  100% {
    -webkit-transform: rotateX(0);
            transform: rotateX(0);
    opacity: 1;
  }
}
@keyframes flip-in-hor-top {
  0% {
    -webkit-transform: rotateX(-80deg);
            transform: rotateX(-80deg);
    opacity: 0;
  }
  100% {
    -webkit-transform: rotateX(0);
            transform: rotateX(0);
    opacity: 1;
  }
}


/* on cache les flèches des champs de type number */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

.shake-horizontal {
  animation: shake-horizontal 0.8s cubic-bezier(0.455, 0.030, 0.515, 0.955) both;
}

@-webkit-keyframes shake-horizontal {
  0%,
  100% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
  }
  10%,
  30%,
  50%,
  70% {
    -webkit-transform: translateX(-10px);
            transform: translateX(-10px);
  }
  20%,
  40%,
  60% {
    -webkit-transform: translateX(10px);
            transform: translateX(10px);
  }
  80% {
    -webkit-transform: translateX(8px);
            transform: translateX(8px);
  }
  90% {
    -webkit-transform: translateX(-8px);
            transform: translateX(-8px);
  }
}
@keyframes shake-horizontal {
  0%,
  100% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
  }
  10%,
  30%,
  50%,
  70% {
    -webkit-transform: translateX(-10px);
            transform: translateX(-10px);
  }
  20%,
  40%,
  60% {
    -webkit-transform: translateX(10px);
            transform: translateX(10px);
  }
  80% {
    -webkit-transform: translateX(8px);
            transform: translateX(8px);
  }
  90% {
    -webkit-transform: translateX(-8px);
            transform: translateX(-8px);
  }
}


</style>