<template>
  <div class="container shadow formulary">
    <div class="row text-center">
      <div class="col py-3 head" :class="[ view == 1 ? 'active':'nactive' ]" @click="view = 1">Connexion</div>
      <div class="col py-3 head" :class="[ view == 2 ? 'active':'nactive' ]" @click="view = 2">Inscription</div>
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
          </div>
          <div class="form-group">
            <label for="InputPassword1">Mot de passe</label>
            <input type="password" class="form-control" id="InputPassword1" v-model="form2.password">
          </div>
          <div class="form-group">
            <label for="InputPassword2">Confirmez le mot de passe</label>
            <input type="password" class="form-control" id="InputPassword2" v-model="form2.password_confirmation">
          </div>
          <button @click.prevent="register()" type="submit" class="btn btn-outline-primary">Inscription</button>
        </form>
      </transition>
    </div>
  </div>
</template>

<script>
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
      errors1: []
    }
  },
  methods: {
    handleLogin() {
      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/login', this.form1).then(response => {
          console.log("User Logged In");
          this.$root.$data.isUserLogged = true;
          this.$root.$data.user = response.data;
          this.$router.push('/profile');
        }).catch(error => {
          this.errors1 = error.response.data.errors;
        }) 
      })
    },
    register() {
      let form = {
        name: this.form2.firstname + ' ' + this.form2.lastname,
        email: this.form2.email,
        password: this.form2.password,
        password_confirmation: this.form2.password_confirmation
      };
      axios.post('/api/register', form).then(() => {
        console.log("User has been created");
      }).catch(error => {
        console.log(error);
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
  border-bottom: 3px solid #08A873;
}

.nactive {
  border-bottom: 1px solid rgb(230, 230, 230);
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