import master from '@/pages/auth';
import login from '@/pages/auth/login.vue';
import { AUTH_LOGIN } from '@/configs/routeNames';

export default { 
  path: '/auth', redirect: { name: AUTH_LOGIN }, component: master,
  children: [
    {
      path: 'login', name: AUTH_LOGIN, component: login,
    },
  ]
}
