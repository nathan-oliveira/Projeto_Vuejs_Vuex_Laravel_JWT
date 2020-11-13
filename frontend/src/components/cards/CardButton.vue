<template>
  <div>
    <a v-if="disabled" v-bind:class="`btn btn-${color} btn-${tamanho} btn-block`" disabled>
      <i v-bind:class="`fa fa-${icon}`"></i>&nbsp; {{ titulo }}
    </a>
    <a v-else :href="link" v-bind:class="`btn btn-${color} btn-${tamanho} btn-block`" target="_blank">
      <i v-bind:class="`fa fa-${icon}`"></i>&nbsp; {{ titulo }}
    </a>
  </div>
</template>

<script>
export default {
  name: "CardButton",
  props: ['color', 'tamanho', 'titulo', 'icon', 'link', 'disabled'],
};
</script>

<style scoped>
.btn {
  margin-right: 4px;
}
</style>
