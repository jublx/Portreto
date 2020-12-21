<template>
  <div class="container shadow formulary">
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
            <small v-if="this.errors1.email" class="form-error">{{ errors1.email[0] }}</small>
          </div>
          <button @click.prevent="handleLogin()" type="submit" class="btn btn-outline-primary">Connexion</button>
        </form>
        <form v-else class="form2" key="2">
          <div class="form-group">
            <div class="row">
              <div class="col-md form-group">
                <label for="InputFirstName">Prénom</label>
                <input type="text" class="form-control" id="inputFirstName" v-model="form2.firstname">
                <small v-if="this.errors2.name" class="form-error">{{ errors2.name[0] }}</small>
              </div>
              <div class="col-md form-group">
                <label for="InputName">Nom</label>
                <input type="text" class="form-control" id="inputName" v-model="form2.lastname">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="InputEmail">Adresse e-mail</label>
            <input type="text" class="form-control" id="inputEmail" v-model="form2.email">
            <small v-if="this.errors2.email" class="form-error">{{ errors2.email[0] }}</small>
          </div>
          <div class="form-group">
            <label for="InputPassword1">Mot de passe</label>
            <input type="password" class="form-control" id="InputPassword1" v-model="form2.password">
          </div>
          <div class="form-group">
            <label for="InputPassword2">Confirmez le mot de passe</label>
            <input type="password" class="form-control" id="InputPassword2" v-model="form2.password_confirmation">
            <small v-if="this.errors2.password" class="form-error">{{ errors2.password[0] }}</small>
          </div>
          <button @click.prevent="register()" type="submit" class="btn btn-outline-primary">Inscription</button>
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
        firstname: '',
        lastname: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
      errors1: [],
      errors2: [],
      success: false
    }
  },
  store,
  methods: {
    handleLogin() {
      axios.get('/sanctum/csrf-cookie').then(() => {
        axios.post('/login', this.form1).then(() => {
          axios.get('/api/user').then(response => {
            store.commit('SET_USER', response.data);
            setTimeout(() => {
              this.$router.push('/profile');
            }, 1500);
          })
        }).catch(error => {
          this.errors1 = error.response.data.errors;
        })
      })
    },
    register() {
      axios.post('/api/register', {
        name: this.form2.firstname + ' ' + this.form2.lastname,
        email: this.form2.email,
        password: this.form2.password,
        password_confirmation: this.form2.password_confirmation
      }).then(() => {
        console.log("User has been created");
        this.success = true;
      }).catch(error => {
        console.log(error.response.data.errors);
        this.errors2 = error.response.data.errors;
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
  background-color: #08A873;
  color: #f8fafc;
  box-shadow: inset -15px -20px 31px -23px rgba(0,0,0,0.75);
}

.nactiver {
  background-color: #08A873;
  color: #f8fafc;
  box-shadow: inset 15px -20px 31px -23px rgba(0,0,0,0.75);
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
  margin: 6px 0 0 20px;
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