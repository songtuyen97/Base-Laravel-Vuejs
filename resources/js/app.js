import Vue from 'vue';
import App from './components/App.vue';
import router from './router';
import store from './store';
import vuetify from '@/plugins/vuetify';
import i18n from '@/plugins/i18n';
require('./bootstrap');

Vue.use({
  install() {
    Vue.router = router;
  }
})
Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
  router,
  store,
  template: '<App/>',
  vuetify,
  i18n,
  ...App
})
