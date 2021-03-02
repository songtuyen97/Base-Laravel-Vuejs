import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)
// import modules
import wellcome from '@/store/modules/welcome';
import lang from '@/store/modules/lang';

export default new Vuex.Store({
  modules: {
    wellcome,
    lang,
  },
})
