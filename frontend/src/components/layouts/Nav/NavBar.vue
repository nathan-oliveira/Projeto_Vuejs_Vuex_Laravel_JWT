<template>
  <header class="main-header" v-if="usuario">
    <router-link to="/" class="logo">
      <span class="logo-mini"><b>A</b>LT</span>
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </router-link>
    <nav class="navbar navbar-static-top">
      <router-link
        to=""
        class="sidebar-toggle"
        data-toggle="push-menu"
        role="button"
      >
        <span class="sr-only">Nathan Oliveira</span>
      </router-link>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <router-link to="" class="dropdown-toggle" data-toggle="dropdown">
              <!-- <img
                src="dist/img/user2-160x160.jpg"
                class="user-image"
                alt="User Image"
              /> -->
              <span class="hidden-xs">{{ usuario.name }}</span>
            </router-link>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img
                  :src="usuario.imagem || 'https://site.ieee.org/r9-sac/files/2016/04/user.png'"
                  class="img-circle"
                  alt="User Image"
                />
                <p>
                  {{ usuario.name }}
                  <small>{{ usuario.email }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <router-link to="/perfil" class="btn btn-default btn-flat"
                    >Perfil</router-link
                  >
                </div>
                <div class="pull-right">
                  <a v-on:click="sair()" class="btn btn-default btn-flat">
                    Sair
                  </a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a @click="sair()" class="button-sair"> <i class="fas fa-sign-out-alt"></i> Sair </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
  name: "NavBar",
  data() {
    return {
      usuario: false,
    };
  },
  created() {
    const usuarioAux = this.$store.getters.getUsuario;
    if(!usuarioAux) this.usuario = false;
    if (usuarioAux) this.usuario = usuarioAux;
  },
  methods: {
    sair() {
      this.$store.commit('setUsuario', null);
      localStorage.removeItem('usuario');
      this.usuario = false;
      this.$router.push("/login");
    },
  },
};
</script>

<style scoped>
.button-sair {
  cursor: pointer;
}
</style>
