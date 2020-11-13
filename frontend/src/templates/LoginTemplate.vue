<template>
  <div>
    <NavBar />
    <slot />
    <Footer />
  </div>
</template>

<script>
import NavBar from "@/components/layouts/Nav/NavLogin.vue";
import Footer from "@/components/layouts/Footer.vue";

export default {
  name: "LoginTemplate",
  components: {
    NavBar,
    Footer,
  },
  beforeCreate() {
    const usuarioAux = this.$store.getters.getUsuario;

    if (usuarioAux) {
      this.$router.push("/");
    }
  },
};
</script>

<style scoped>
.login {
  background-color: #ecf0f5 !important;
}
.main-footer {
  margin-left: 0 !important;
}
</style>
