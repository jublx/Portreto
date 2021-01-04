import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    isUserLogged: false,
    user: {},
    user_infos: {},
    user_contacts: [],
    register_errors: [],
    login_errors: [],
    number_of_followers: 0
  },

  mutations: {
    SET_IS_USER_LOGGED: (state, value) => state.isUserLogged = value,
    SET_USER: (state, value) => {
      state.user = value;
      state.isUserLogged = true;
    },
    SET_USER_INFOS: (state, value) => state.user_infos = value,
    SET_USER_CONTACTS: (state, value) => state.user_contacts = value,
    SET_REGISTER_ERRORS: (state, value) => state.register_errors = value,
    SET_LOGIN_ERRORS: (state, value) => state.login_errors = value,
    SET_NUMBER_OF_FOLLOWERS: (state, value) => state.number_of_followers = value,

    CLEAR_REGISTER_ERRORS: state => state.register_errors = [],
    CLEAR_LOGIN_ERRORS: state => state.login_errors = [],
    CLEAR_USER: state => {
      state.isUserLogged = false;
      state.user = {};
      state.user_infos = {};
      state.user_contacts = [];
      state.number_of_followers = 0;
    },
  },

  getters: {
    isUserLogged: state => {return state.isUserLogged},
    user: state => {return state.user },
    user_infos: state => {return state.user_infos},
    user_contacts: state => {return state.user_contacts},
    user_number_of_followers: state => {return state.number_of_followers},
    register_errors: state => {return state.register_errors},
    login_errors: state => {return state.login_errors},
  },
})