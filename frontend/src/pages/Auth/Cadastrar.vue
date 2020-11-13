<template>
  <LoginTemplate>
    <div class="row login">
      <div class="login-box">
        <div class="login-box-body">
          <div class="login-logo">
            <a href="#">Criar Conta</a>
          </div>
          <hr />
          <form>
            <div class="form-group has-feedback">
              <input
                type="text"
                class="form-control"
                placeholder="Nome Completo"
                v-model="usuario.name"
              />
              <span
                class="glyphicon glyphicon-user form-control-feedback"
              ></span>
            </div>
            <div class="form-group has-feedback">
              <input
                type="email"
                class="form-control"
                placeholder="Email"
                v-model="usuario.email"
              />
              <span
                class="glyphicon glyphicon-envelope form-control-feedback"
              ></span>
            </div>
            <div class="form-group has-feedback">
              <input
                type="password"
                class="form-control"
                placeholder="Senha"
                v-model="usuario.password"
              />
              <span
                class="glyphicon glyphicon-lock form-control-feedback"
              ></span>
            </div>
            <div class="form-group has-feedback">
              <input
                type="password"
                class="form-control"
                placeholder="Confirmar Senha"
                v-model="usuario.password_confirmation"
              />
              <span
                class="glyphicon glyphicon-lock form-control-feedback"
              ></span>
            </div>
            <div class="row">
              <div class="col-xs-8 cadastrar-link">
                <router-link to="/login">
                  Já possui uma conta? Entrar agora
                </router-link>
              </div>
              <div class="col-xs-4">
                <a
                  v-on:click="cadastro()"
                  class="btn btn-primary btn-block btn-flat"
                >
                  Cadastrar
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </LoginTemplate>
</template>

<script>
import { api } from "@/services";
import LoginTemplate from "@/templates/LoginTemplate.vue";

export default {
  name: "Login",
  data() {
    return {
      usuario: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
    };
  },
  components: {
    LoginTemplate,
  },
  methods: {
    cadastro() {
      api
        .post("/cadastro", {
          name: this.usuario.name,
          email: this.usuario.email,
          password: this.usuario.password,
          password_confirmation: this.usuario.password_confirmation,
        })
        .then((resp) => {
          if (resp.data.status) {
            // login com sucesso
            this.$store.commit('setUsuario', resp.data.usuario);
            localStorage.setItem("usuario", JSON.stringify(resp.data.usuario));
            this.$router.push("/");
          } else if (resp.data.status === false && resp.data.validacao) {
            // erros de validação
            let erros = "";

            for (let erro of Object.values(resp.data.erros)) {
              erros += erro + " ";
            }

            alert(erros);
          } else {
            alert("Erro no cadastro! tente novamente mais tarde");
          }
        })
        .catch((e) => {
          alert("Erro! Tente novamento mais tarde!");
        });
    },
  },
};
</script>

<style scoped>
.login {
  min-height: 100vh !important;
}
.login-box,
.register-box {
  margin: 10% auto !important;
}

.cadastrar-link {
  margin-top: 2%;
}
</style>
