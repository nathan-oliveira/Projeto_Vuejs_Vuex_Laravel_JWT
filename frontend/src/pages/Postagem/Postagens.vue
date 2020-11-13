<template>
  <SiteTemplate>
    <div class="content-wrapper">
      <BreadCrumb titulo="Postagem" pagina="Listagem de Postagem" />
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li
                  class="active"
                  @click="AlterarBreadCrumb('Listagem de Postagens')"
                >
                  <a href="#tab_1" data-toggle="tab">Listagem</a>
                </li>
                <li @click="AlterarBreadCrumb('Cadastro de Postagens')">
                  <a href="#tab_2" data-toggle="tab">Cadastrar</a>
                </li>
                <li @click="AlterarBreadCrumb('Alteração de Postagens')">
                  <a href="#tab_3" data-toggle="tab">Alterar</a>
                </li>
                <li @click="AlterarBreadCrumb('Exclusão de Postagens')">
                  <a href="#tab_4" data-toggle="tab">Excluir</a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <b>Listagem</b>
                </div>
                <div class="tab-pane" id="tab_2">
                  <Cadastrar />
                </div>
                <div class="tab-pane" id="tab_3">
                  <b>Alterar</b>
                </div>
                <div class="tab-pane" id="tab_4">
                  <b>Excluir</b>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </SiteTemplate>
</template>

<script>
import SiteTemplate from "@/templates/SiteTemplate.vue";

import BreadCrumb from "@/components/layouts/BreadCrumb.vue";
import Cadastrar from "@/pages/Postagem/Cadastrar.vue";

export default {
  name: "Postagem",
  components: {
    SiteTemplate,
    BreadCrumb,
    Cadastrar,
  },
  methods: {
    AlterarBreadCrumb(texto) {
      const bread = document.getElementsByClassName("bread-pagina");
      bread[0].innerText = texto;
    },
  },

};
</script>
