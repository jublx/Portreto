import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    isUserLogged: false,
    user: {},
    user_infos: {},
    loaded: false
  },

  mutations: {
    SET_IS_USER_LOGGED: (state, value) => state.isUserLogged = value,
    SET_USER: (state, value) => {
      state.user = value;
      state.isUserLogged = true;
    },
    SET_USER_INFOS: (state, value) => state.user_infos = value,
    CLEAR_USER: state => {
      state.isUserLogged = false;
      state.user = {};
      state.user_infos = {};
    },
    SET_LOADED: (state, value) => state.loaded = value
  },

  getters: {
    isUserLogged: state => {return state.isUserLogged},
    user: state => {return state.user },
    user_infos: state => {return state.user_infos},
    loaded: state => {return state.loaded}
  },

  actions: {
    
  }
})