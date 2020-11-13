<template>
  <div>
    <a @click="curtida(id)" v-bind:class="`btn btn-${color} btn-${tamanho} btn-block`">
      <i v-bind:class="`fa fa-${icon}`"></i>&nbsp; {{ curtiu }} ( {{totalCurtidas}} )
    </a>
  </div>
</template>

<script>
import { api } from "@/services";

export default {
  name: "CardButton",
  props: ['id', 'color', 'tamanho', 'icon', 'qtdeCurtidas', 'curtiuConteudo'],
  data() {
    console.log(this.qtdeCurtidas)

    return {
      curtiu: this.curtiuConteudo ? 'Descurtir' : 'Curtir',
      totalCurtidas: this.qtdeCurtidas
    }
  },
  methods: {
    curtida(id) {
      api.put(`/conteudo/curtir/${id}`, {}, {
        "headers": {
          "Authorization": `Bearer ${this.$store.getters.getToken}`
        }
      }).then((resp) => {
        if(resp.data.status) {
          this.totalCurtidas = resp.data.curtidas
          this.$store.commit('setConteudosLinhaTempo', resp.data.lista.conteudos.data);
          //lista
          if (this.curtiu === 'Curtir') {
            this.curtiu = 'Descurtir'
          } else {
            this.curtiu = 'Curtir'
          }
        } else {
          alert(resp.data.errors)
        }
      }).catch((err) => {
        alert('OPS! Não foi possivel realizar a operação')
      })
    }
  },
};
</script>

<style scoped>
.btn {
  margin-right: 4px;
}
</style>
