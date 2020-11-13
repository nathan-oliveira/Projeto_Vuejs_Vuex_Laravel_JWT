<template>
  <SiteTemplate>
    <div class="content-wrapper">
      <BreadCrumb titulo="Dashboard" pagina="Página Inicial" />
      <div class="row">
        <div class="content">
          <Card
            v-for="item in listaConteudos"
            :key="item.id"
            :author="item.user.name"
            :imagem="item.user.imagem"
            :datetime="item.data"
          >
            <CardContent
              :texto="item.texto"
              :titulo="item.titulo"
              :imagem="item.imagem"
              :link="item.link"
            />

            <div class="timeline-footer">
              <div class="row">
                <div class="col-xs-6">
                  <CardButton
                    :disabled="item.link == '#' ? true : false "
                    color="primary"
                    tamanho="md"
                    titulo="Visualizar"
                    icon="eye"
                    :link="item.link"
                  />
                </div>
                <div class="col-xs-6">
                  <CardButtonCurtidas
                    :id="item.id"
                    color="danger"
                    tamanho="md"
                    icon="gittip"
                    :qtdeCurtidas="item.total_curtidas"
                    :curtiuConteudo="item.curtiu_conteudo"
                  />
                </div>
              </div>
            </div>
          </Card>
        </div>
      </div>
    </div>
  </SiteTemplate>
</template>

<script>
/* eslint-disabled max-len spaced-comment */
import { api } from "@/services";
import SiteTemplate from "@/templates/SiteTemplate.vue";
import BreadCrumb from "@/components/layouts/BreadCrumb.vue";
import Card from "@/components/cards/Card.vue";
import CardContent from "@/components/cards/CardContent.vue";
import CardButton from "@/components/cards/CardButton.vue";
import CardButtonCurtidas from "@/components/cards/CardButtonCurtidas.vue";

export default {
  name: "home",
  components: {
    SiteTemplate,
    BreadCrumb,
    Card,
    CardContent,
    CardButton,
    CardButtonCurtidas,
  },
  created() {
    let usuarioAux = this.$store.getters.getUsuario;
    if(usuarioAux) {
      api
        .get("/conteudo/listar", {
          "headers": {
            "Authorization": `Bearer ${this.$store.getters.getToken}`
          }
        })
        .then((resp) => {
          if(resp.data.status) {
            this.$store.commit('setConteudosLinhaTempo', resp.data.conteudos.data);
          }
        })
        .catch((e) => {
          console.log('ERROR =>', e);
          alert("Erro! Tente novamento mais tarde!");
        });
    }
  },
  //executa quando está carregando, quando quer informar uma ação para o componente que está sendo criado/atualizado
  computed: {
    listaConteudos() {
      return this.$store.getters.getConteudosLinhaTempo;
    }
  }
};
</script>
