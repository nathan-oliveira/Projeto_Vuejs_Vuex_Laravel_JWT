<template>
  <li class="treeview">
    <a>
      <i v-bind:class="`fa fa-${icon}`"></i> <span>Postagens</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <slot></slot>
  </li>
</template>

<script>
export default {
  name: "SideMenuItemTree",
  props: {
    icon: String,
  },
};
</script>
