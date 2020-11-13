<template>
  <aside class="main-sidebar" v-if="usuario">
    <section class="sidebar">
      <SideMenuUserPanel :nome="usuario.name" status="Online" :imagem="usuario.imagem" />
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <SideMenuItem icon="dashboard" titulo="Dashboard" url="/" />
        <SideMenuItem icon="book" titulo="Adicionar" url="/postagem" />
        <!--
        <SideMenuItemTree icon="book">
          <SideMenuItemView>
            <SideMenuItem
              active="true"
              icon="plus"
              titulo="Adicionar"
              url="/postagem"
            />
          </SideMenuItemView>
        </SideMenuItemTree>
        -->
      </ul>
    </section>
  </aside>
</template>

<script>
import SideMenuItem from "@/components/layouts/SideBar/SideMenuItem.vue";
// import SideMenuItemTree from "@/components/layouts/SideBar/SideMenuItemTree.vue";
// import SideMenuItemView from "@/components/layouts/SideBar/SideMenuItemView.vue";
import SideMenuUserPanel from "@/components/layouts/SideBar/SideMenuUserPanel.vue";

export default {
  name: "SideMenu",
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
  components: {
    SideMenuItem,
    // SideMenuItemTree,
    // SideMenuItemView,
    SideMenuUserPanel,
  },
};
</script>
