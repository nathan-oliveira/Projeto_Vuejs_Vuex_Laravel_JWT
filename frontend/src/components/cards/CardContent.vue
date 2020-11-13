<template>
  <div class="timeline-body">
    <div class="row">
      <div class="col-sm-12" v-if="imagem && imagem != '#'">
        <a v-if="link && link != '#'" :href="link" target="_blank">
          <img :src="imagem" />
        </a>

      </div>
      <div v-else class="col-sm-12">
        <img src="https://www.biotecdermo.com.br/wp-content/uploads/2016/10/sem-imagem-8.jpg" />
      </div>
      <div class="col-sm-12">
        <h4>{{ titulo }}</h4>
        <p>{{ texto }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CardContent",
  props: ['texto', 'imagem', 'link', 'titulo'],
};
</script>

<style scoped>
h4 {
  color: #1d1d1d;
}
</style>
