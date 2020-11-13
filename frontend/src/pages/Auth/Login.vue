<template>
  <LoginTemplate>
    <div class="row login">
      <div class="login-box">
        <div class="login-box-body">
          <div class="login-logo">
            <a href="#">Fazer Login</a>
          </div>
          <hr />
          <form method="post">
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
            <div class="row">
              <div class="col-xs-8 cadastrar-link">
                <router-link to="/cadastrar">
                  Não possui uma conta? Criar agora
                </router-link>
              </div>
              <div class="col-xs-4">
                <a
                  class="btn btn-primary btn-block btn-flat"
                  v-on:click="login()"
                >
                  Entrar
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
      usuario: { email: "", password: "" },
    };
  },
  components: {
    LoginTemplate,
  },
  methods: {
    login() {
      api
        .post("/login", {
          email: this.usuario.email,
          password: this.usuario.password,
        })
        .then((resp) => {
          if (resp.data.status) {
            // login com sucesso
            this.$store.commit('setUsuario', resp.data.usuario);
            localStorage.setItem("usuario", JSON.stringify(resp.data.usuario));
            this.$router.push("/");
          } else if (resp.data.status === false && resp.data.validacao) {
            let erros = "";

            for (let erro of Object.values(resp.data.errors)) {
              erros += erro + " ";
            }

            alert(erros);
          } else {
            // erros de validação
            alert('Login inválido!');
          }
        })
        .catch((e) => {
          console.log(e);
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
