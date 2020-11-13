<template>
  <section class="content-header">
    <h1>
      {{ titulo }}
      <small class="bread-pagina">{{ pagina }}</small>
    </h1>
    <ol class="breadcrumb">
      <li>
        <router-link to="/"><i class="fa fa-dashboard"></i> Home</router-link>
      </li>
      <li class="active">{{ titulo }}</li>
    </ol>
  </section>
</template>

<script>
export default {
  name: "BreadCrumb",
  props: {
    titulo: String,
    pagina: String,
  },
};
</script>
