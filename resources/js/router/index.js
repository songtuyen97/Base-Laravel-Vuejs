import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
  routes: [
    require('@/pages/welcome/router').default,
    require('@/pages/auth/router').default,
  ],
  base: '/',
  mode: 'history',
  linkActiveClass: 'active',
})
