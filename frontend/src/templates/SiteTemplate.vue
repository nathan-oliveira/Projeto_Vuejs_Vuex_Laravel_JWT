<template>
  <div class="wrapper">
    <NavBar />
    <SideBar />
    <slot />
    <Footer />
  </div>
</template>

<script>
import NavBar from "@/components/layouts/Nav/NavBar.vue";
import SideBar from "@/components/layouts/SideBar/SideMenu.vue";
import Footer from "@/components/layouts/Footer.vue";

export default {
  name: "SiteTemplate",
  components: {
    NavBar,
    SideBar,
    Footer,
  },
  beforeCreate() {
    const usuarioAux = this.$store.getters.getUsuario;
    if (!usuarioAux) {
      this.$router.push("/login");
    }
  },
};
</script>
