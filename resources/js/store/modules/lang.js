import i18n from '@/plugins/i18n'

const state = () => ({
  locale: 'en',
})

const getters = {
  locale: state => state.locale,
}

const mutations = {
  SET_LOCALE(state, locale) {
    state.locale = locale;
  },
}

const actions = {
  setLocale({ commit }, locale) {
    i18n.locale = locale;

    commit('SET_LOCALE', locale);
  },
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters,
}
