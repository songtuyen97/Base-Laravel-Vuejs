import Vue from 'vue';
import VueI18n from 'vue-i18n';

Vue.use(VueI18n);

// messages
import * as en from '@/lang/en';
import * as jp from '@/lang/jp';

const messages = {
  en,
  jp,
};

const i18n = new VueI18n({
  locale: 'en',
  messages
});

export default i18n;
