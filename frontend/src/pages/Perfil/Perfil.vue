<template>
  <SiteTemplate>
    <div class="content-wrapper">
      <BreadCrumb titulo="Perfil" pagina="Configuração de Perfil" />
      <div class="content">
        <div class="row">
          <div class="col-md-3">
            <div class="box box-primary">
              <div class="box-body box-profile">
                <img
                  class="profile-user-img img-responsive img-circle"
                  :src="usuario.imagem || 'https://site.ieee.org/r9-sac/files/2016/04/user.png'"
                  alt="User profile picture"
                />

                <h3 class="profile-username text-center">{{ usuario.name }}</h3>

                <p class="text-muted text-center">{{ usuario.email }}</p>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="box box-primary">
              <div class="box-body box-profile">
                <form>
                  <div class="form-group has-feedback">
                    <label class="label2">Nome:</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Nome Completo"
                      v-model="usuario.name"
                    />
                  </div>
                  <div class="form-group has-feedback">
                    <label>E-mail</label>
                    <input
                      type="email"
                      class="form-control"
                      placeholder="Email"
                      v-model="usuario.email"
                    />
                  </div>
                  <div class="form-group has-feedback">
                    <label>Foto</label>
                    <input
                      type="file"
                      class="form-control"
                      v-on:change="salvaImagem"
                    />
                  </div>
                  <div class="form-group has-feedback">
                    <label>Senha:</label>
                    <input
                      type="password"
                      class="form-control"
                      placeholder="Senha"
                      v-model="usuario.password"
                    />
                  </div>
                  <div class="form-group has-feedback">
                    <label>Confirma Senha</label>
                    <input
                      type="password"
                      class="form-control"
                      placeholder="Confirmar Senha"
                      v-model="usuario.password_confirmation"
                    />
                  </div>

                  <div class="col-sm-12">
                    <a v-on:click="perfil()" class="btn btn-primary pull-right">
                      <i class="fa fa-floppy-o" aria-hidden="true">&nbsp;</i>
                      Atualizar
                    </a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </SiteTemplate>
</template>

<script>
import { api } from "@/services";
import SiteTemplate from "@/templates/SiteTemplate.vue";
import BreadCrumb from "@/components/layouts/BreadCrumb.vue";

export default {
  name: "Perfil",
  data() {
    return {
      usuario: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        imagem: ""
      },
    };
  },
  components: {
    SiteTemplate,
    BreadCrumb,
  },
  created() {
    const usuarioAux = this.$store.getters.getUsuario;
    if (usuarioAux) {
      this.usuario.name = usuarioAux.name;
      this.usuario.email = usuarioAux.email;
      this.usuario.imagem = usuarioAux.imagem;
    }
  },
  methods: {
    salvaImagem(e) {
      let arquivo = e.target.files || e.dataTransfer.files;

      if(arquivo.length > 0) {
        let reader = new FileReader();
        reader.onloadend = (e) => {
          this.usuario.imagem = e.target.result;
        };

        reader.readAsDataURL(arquivo[0]);
      }
    },
    perfil() {
      api
        .put(
          "/perfil",
          {
            name: this.usuario.name,
            email: this.usuario.email,
            imagem: this.usuario.imagem,
            password: this.usuario.password,
            password_confirmation: this.usuario.password_confirmation,
          },
          {
            "headers": {
              "authorization": `Bearer ${this.$store.getters.getToken}`,
            },
          }
        )
        .then((resp) => {
          console.log(resp)
          if (resp.data.status) {
            // login com sucesso
            this.usuario = resp.data.usuario;
            this.$store.commit('setUsuario', this.usuario);
            localStorage.setItem("usuario", JSON.stringify(this.usuario));
            alert("Perfil atualizado!");
          } else if (resp.data.status === false && resp.data.validacao) {
            // erros de validação
            let erros = "";

            for (let erro of Object.values(resp.data.erros)) {
              erros += erro + " ";
            }

            alert(erros);
          }
        })
        .catch((e) => {
          console.log('ERROR =>', e);
          alert("Erro! Tente novamento mais tarde!");
        });
    },
  },
};
</script>

<style scoped>
.form-group {
  margin-bottom: 0px !important;
  margin: 0 10px 0px 10px !important;
}
label {
  margin-bottom: 0px !important;
}
label:not(.label2),
.btn {
  margin-top: 10px !important;
}
</style>
