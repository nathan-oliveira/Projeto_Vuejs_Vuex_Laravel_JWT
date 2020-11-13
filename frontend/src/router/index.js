import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import(/* webpackChunkName: "home" */ '../pages/Home/Home.vue'),
  },
  {
    path: '/login',
    name: 'login',
    component: () => import(/* webpackChunkName: "login" */ '../pages/Auth/Login.vue'),
  },
  {
    path: '/cadastrar',
    name: 'cadastrar',
    component: () => import(/* webpackChunkName: "cadastrar" */ '../pages/Auth/Cadastrar.vue'),
  },
  {
    path: '/postagem',
    name: 'postagem',
    component: () => import(/* webpackChunkName: "postagem" */ '../pages/Postagem/Postagens.vue'),
  },
  {
    path: '/perfil',
    name: 'perfil',
    component: () => import(/* webpackChunkName: "perfil" */ '../pages/Perfil/Perfil.vue'),
  },
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
});

export default router;
