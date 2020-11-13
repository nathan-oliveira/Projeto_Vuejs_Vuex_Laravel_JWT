<template>
  <header class="main-header">
    <router-link to="/" class="logo">
      <span class="logo-mini"><b>A</b>LT</span>
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </router-link>
    <nav class="navbar navbar-static-top">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <router-link to="/login">
              <i class="fa fa-user" aria-hidden="true"></i> Entrar
            </router-link>
          </li>
          <li>
            <router-link to="/cadastrar">
              <i class="fa fa-user-plus" aria-hidden="true"></i> Cadastrar
            </router-link>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
  name: "NavLogin",
};
</script>

<style scoped>
.logo {
  background-color: #3c8dbc !important;
  text-align: initial !important;
}

.main-header {
  margin-right: -15px;
}

.navbar-nav {
  margin-right: 15px;
}
</style>
