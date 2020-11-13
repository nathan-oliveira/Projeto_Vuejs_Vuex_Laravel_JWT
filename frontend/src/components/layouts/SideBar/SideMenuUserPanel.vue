<template>
  <div class="user-panel">
    <div class="pull-left image">
      <img
        :src="imagem || 'https://site.ieee.org/r9-sac/files/2016/04/user.png'"
        class="img-circle"
        alt="User Image"
      />
    </div>

    <div class="pull-left info">
      <p>{{ nome.split(' ')[0] }} {{ nome.split(' ')[1]}}</p>
      <router-link to="/perfil" class="btn btn-sm btn-primary">Ver Perfil</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "SideMenuUserPanel",
  props: {
    nome: String,
    status: String,
    imagem: String
  },
};
</script>

<style scoped>
.btn-sm {
  margin-top: -6px !important;
}
.user-panel > .info > a {
  padding: 5px 10px !important;
}
</style>
