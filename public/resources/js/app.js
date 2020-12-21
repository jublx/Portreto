require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// importations des composants
import Navbar from './components/Navbar.vue';
import IndexPage from './components/IndexPage.vue';
import About from './components/About.vue';
import Progress from './components/ProgressState.vue'
import Contact from './components/Contact.vue';
import Footer from './components/Footer.vue';
import ProfilePage from './components/ProfilePage.vue';

// définitions des routes
const routes = [
  {
    path: '/',
    component: IndexPage
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
    path: '/profile',
    component: ProfilePage
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

const vm = new Vue({
    el: '#app',
    data: {
      isUserLogged: false,
      user: {}
    },
    router: router,
    components: {
      'navbar': Navbar,
      'default-footer': Footer
    },
    beforeCreate() {
      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.get('/api/user').then(response => {
          this.isUserLogged = true;
          this.user = response.data;
        }).catch(error => {
          console.log('User not logged in');
        })
      })
    }
});
