<template>
  <li>
    <router-link :to="url">
      <i v-bind:class="`fa fa-${icon}`"></i>
      <span>{{ titulo }}</span>
    </router-link>
  </li>
</template>

<script>
export default {
  name: "SideMenuItem",
  props: {
    icon: String,
    titulo: String,
    url: String,
  },
};
</script>
