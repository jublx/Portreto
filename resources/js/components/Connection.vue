<template>
  <div class="container shadow formulary bg-light">
    <div class="row text-center">
      <div class="col py-3 head" :class="[ view == 1 ? 'active':'nactivel' ]" @click="view = 1">Connexion</div>
      <div class="col py-3 head" :class="[ view == 2 ? 'active':'nactiver' ]" @click="view = 2">Inscription</div>
    </div>
    <div class="row form-content">
      <transition :enter-active-class="getFormAdaptedAnimation" leave-active-class="fade-out" mode="out-in">
        <form v-if="this.view == 1" class="form1" key="1">
          <div class="form-group">
            <label for="InputLogin">Adresse e-mail</label>
            <input type="text" class="form-control" id="inputLogin" v-model="form1.email">
          </div>
          <div class="form-group">
            <label for="InputPassword1">Mot de passe</label>
            <input type="password" class="form-control" id="InputPassword1" v-model="form1.password">
            <small v-if="loginErrors.email" class="form-error">{{ loginErrors.email[0] }}</small>
            <small v-if="loginErrors.password" class="form-error">{{ loginErrors.password[0] }}</small>
          </div>
          <button @click.prevent="handleLogin()" type="submit" class="btn btn-primary">Connexion</button>
        </form>
        <form v-else class="form2" key="2">
          <div class="form-group">
            <div class="row">
              <div class="col-md form-group">
                <label for="InputFirstName">Prénom</label>
                <input type="text" class="form-control" id="inputFirstName" v-model="form2.first_name">
                <small v-if="registerErrors.name" class="form-error">{{ registerErrors.name[0] }}</small>
              </div>
              <div class="col-md form-group">
                <label for="InputName">Nom</label>
                <input type="text" class="form-control" id="inputName" v-model="form2.name">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="InputEmail">Adresse e-mail</label>
            <input type="text" class="form-control" id="inputEmail" v-model="form2.email">
            <small v-if="registerErrors.email" class="form-error">{{ registerErrors.email[0] }}</small>
          </div>
          <div class="form-group">
            <label for="InputPassword1">Mot de passe</label>
            <input type="password" class="form-control" id="InputPassword1" v-model="form2.password">
          </div>
          <div class="form-group">
            <label for="InputPassword2">Confirmez le mot de passe</label>
            <input type="password" class="form-control" id="InputPassword2" v-model="form2.password_confirmation">
            <small v-if="registerErrors.password" class="form-error">{{ registerErrors.password[0] }}</small>
          </div>
          <button @click.prevent="register()" type="submit" class="btn btn-primary">Inscription</button>
          <small v-if="success" class="form-success">Bienvenue ! Essayez maintenant de vous connecter.</small>
        </form>
      </transition>
    </div>
  </div>
</template>

<script>
import store from '../store.js';

export default {
  data() {
    return {
      view: 1,
      form1: {
        email: '',
        password: ''
      },
      form2: {
        name: '',
        first_name: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
      success: false
    }
  },
  store,
  methods: {
    handleLogin() {
      axios.get('/sanctum/csrf-cookie').then(() => {
        axios.post('/login', this.form1).then(() => {
          store.commit('CLEAR_LOGIN_ERRORS');
          axios.get('/api/user').then(response => {
            store.commit('SET_USER', response.data);
            this.$root.getUserInfos();
            this.$root.getUserContacts();
            this.$root.getUserNumberOfFollowers();
            setTimeout(() => {
              this.$router.push('/dashboard');
            }, 1500);
          })
        }).catch(error => {
          store.commit('SET_LOGIN_ERRORS', error.response.data.errors);
        })
      })
    },
    register() {
      axios.post('/api/register', this.form2).then(() => {
        console.log("User has been created");
        store.commit('CLEAR_REGISTER_ERRORS');
        this.success = true;
      }).catch(error => {
        store.commit('SET_REGISTER_ERRORS', error.response.data.errors);
      })
    }
  },
  computed: {
    getFormAdaptedAnimation() {
      if(this.view == 1) {
        return 'fade-in-left';
      } else {
        return 'fade-in-right'
      }
    },
    registerErrors() {
      return store.getters.register_errors;
    },
    loginErrors() {
      return store.getters.login_errors;
    }
  }
}
</script>

<style scoped>
.formulary {
  font-size: 1.4em;
}

.formulary button {
  margin-top: 4vh;
}

.head {
  cursor: pointer;
}

.active {
}

.nactivel {
  background-color: #219e89;
  color: #f8fafc;
  box-shadow: inset -15px -20px 31px -23px rgba(0,0,0,0.75);
  transition: background-color 0.3s ease-in-out;
}

.nactiver {
  background-color: #219e89;
  color: #f8fafc;
  box-shadow: inset 15px -20px 31px -23px rgba(0,0,0,0.75);
  transition: background-color 0.3s ease-in-out;
}

.nactivel:hover {
  background-color: #008383;
}

.nactiver:hover {
  background-color: #008383;
}

.form-content form {
  display: block;
  width: 70%;
}

.form1 {
  margin: 12vh auto 14vh;
}

.form2 {
  margin: 8vh auto 8vh;
}

.form-error {
  color: red;
  font-size: 0.7em;
}

.form-success {
  color: rgb(0, 177, 0);
  margin-left: 20px;
  font-size: 0.7em;
}

.btn {
  font-size: 0.9em;
}

/* ANIMATIONS */
.fade-in-left {
	animation: fade-in-left 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
}

.fade-in-right {
	animation: fade-in-right 0.6s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
}

.rotate-out-center {
	animation: rotate-out-center 0.6s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
}

@keyframes fade-in-left {
  0% {
    transform: translateX(-50px);
    opacity: 0;
  }
  100% {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes fade-in-right {
  0% {
    transform: translateX(50px);
    opacity: 0;
  }
  100% {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes rotate-out-center {
  0% {
    transform: rotate(0);
    opacity: 1;
  }
  100% {
    transform: rotate(-360deg);
    opacity: 0;
  }
}

</style>