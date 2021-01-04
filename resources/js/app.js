require('./bootstrap');

// importations des éléments de Vue 
window.Vue = require('vue');
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// importation du state manager
import store from './store.js';

// importations des composants
import Navbar from './components/Navbar.vue';
import IndexPage from './components/IndexPage.vue';
import About from './components/About.vue';
import Progress from './components/ProgressState.vue'
import Contact from './components/Contact.vue';
import Footer from './components/Footer.vue';
import Dashboard from './components/Dashboard.vue';
import NotFound from './components/NotFound.vue'

// définitions des routes
const routes = [
  {
    path: '/',
    component: IndexPage,
  },
  {
    path: '/about',
    component: About
  },
  {
    path: '/progress',
    component: Progress
  },
  {
    path: '/contact',
    component: Contact
  },
  {
    path: '/dashboard',
    component: Dashboard
  },
  {
    path: '*',
    component: NotFound
  }
]
const router = new VueRouter({
  routes: routes,
  scrollBehavior (to, from, savedPosition) { // on fait une promesse qui permet de scroller la page jusqu'au début lors d'un changement de page
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        resolve({ x: 0, y: 0 })
      }, 100) // délai avant le scroll, à ajuster selon l'animation
    })
  },
  mode: 'history' // évite l'affichage d'un # dans l'url
});

new Vue({
    el: '#app',
    router: router,
    store,
    components: {
      'navbar': Navbar,
      'default-footer': Footer,
    },
    beforeCreate() {
      axios.get('/sanctum/csrf-cookie').then(() => {
        axios.get('/api/user').then(response => {
          store.commit('SET_USER', response.data);
          this.getUserInfos();
          this.getUserContacts();
          this.getUserNumberOfFollowers();
        }).catch(error => {
          console.log('User is not logged in.');
          if(!this.$route.fullPath.localeCompare('/dashboard')) { // si les chaînes de caractères sont identiques, renvoie 0
            this.$router.push('/'); // si l'utilisateur n'est pas authentifié et qu'il souhaite accéder à la page de profil, le renvoie à la page d'accueil
          }
        })
      })
    },
    methods: {
      getUserInfos() {
        axios.get('/sanctum/csrf-cookie').then(() => {
          axios.get('/api/user_infos').then((informations) => {
            store.commit('SET_USER_INFOS', informations.data);
          }).catch(error => {
            console.log("Can't recover user's informations.");
          })
        })
      },
      getUserContacts() {
        axios.get('/sanctum/csrf-cookie').then(() => {
          axios.get('/api/user_contacts').then((response) => {
            store.commit('SET_USER_CONTACTS', response.data);
          }).catch(error => {
            console.log("Can't recover user's contacts.");
          })
        })
      },
      getUserNumberOfFollowers() {
        axios.get('/sanctum/csrf-cookie').then(() => {
          axios.get('/api/number_of_followers').then((response) => {
            store.commit('SET_NUMBER_OF_FOLLOWERS', response.data);
          }).catch(error => {
            console.log("Can't recover user's number of followers.");
          })
        })
      }
    }
});
