import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)

export default new Vuex.Store({
  strict: true,
  state: {
    usuario: localStorage.getItem("usuario") ? JSON.parse(localStorage.getItem("usuario")) : null,
    conteudosLinhaTempo: []
  },
  getters: {
    getUsuario(state) {
      return state.usuario;
    },
    getToken(state) {
      return state.usuario.token;
    },
    getConteudosLinhaTempo(state) {
      return state.conteudosLinhaTempo;
    }
  },
  mutations: {
    setUsuario(state, value) {
      state.usuario = value;
    },
    setConteudosLinhaTempo(state, value) {
      state.conteudosLinhaTempo = value;
    },
  }
})
