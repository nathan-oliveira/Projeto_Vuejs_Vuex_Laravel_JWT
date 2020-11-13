<template>
  <div class="box-body">
    <form role="form">
      <div class="form-group">
        <label>Título:</label>
        <input
          type="text"
          class="form-control"
          placeholder="Título"
          v-model="conteudo.titulo"
        />
      </div>
      <div class="form-group">
        <label>Conteúdo:</label>
        <textarea
          type="text"
          class="form-control"
          rows="5"
          placeholder="O que está acontecendo?"
          v-model="conteudo.texto"
        ></textarea>
      </div>
      <div class="form-group">
        <label>Link:</label>
        <input
          type="text"
          class="form-control"
          placeholder="Link"
          v-model="conteudo.link"
        />
      </div>
      <div class="form-group">
        <label>Imagem:</label>
        <input
          type="text"
          class="form-control"
          placeholder="URL da Imagem"
          v-model="conteudo.imagem"
        />
      </div>
      <a class="btn btn-danger">
        <i class="fa fa-ban" aria-hidden="true">&nbsp;</i> Cancelar
      </a>
      <a @click="addConteudo()" class="btn btn-success pull-right">
        <i class="fa fa-floppy-o" aria-hidden="true">&nbsp;</i> Publicar
      </a>
    </form>
  </div>
</template>

<script>
/* eslint-disabled indent */
import { api } from "@/services";

export default {
  name: "Cadastrar",
  data() {
    return {
      conteudo: {
        titulo: "",
        texto: "",
        link: "",
        imagem: ""
      }
    }
  },
  methods: {
    addConteudo() {
      api.post('/conteudo/adicionar', {
        titulo: this.conteudo.titulo,
        texto: this.conteudo.texto,
        link: this.conteudo.link,
        imagem: this.conteudo.imagem
      }, {
        "headers": {
          "authorization": `Bearer ${this.$store.getters.getToken}`
        }
      }).then((resp) => {
        if(resp.data.status) {
          this.$store.commit('setConteudosLinhaTempo', resp.data.conteudos.data);
          this.$router.push("/");
        } else if (resp.data.status === false && resp.data.validacao) {
            let erros = "";

            for (let erro of Object.values(resp.data.erros)) {
              erros += erro + " ";
            }

            alert(erros);
          }
      }).catch((e) => {
        alert("Erro!")
      })
    }
  },
};
</script>

<style scoped>
textarea {
  resize: vertical;
}

label {
  font-size: 16px;
  font-weight: 400;
}
</style>
