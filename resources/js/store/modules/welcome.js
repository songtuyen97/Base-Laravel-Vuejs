const state = () => ({
  initValue: 123,
})

const getters = {
  initValue: state => state.initValue,
}

const mutations = {
  SET_INIT_VALUE(state, newValue) {
    state.initValue = newValue;
  },
}

const actions = {
  setInitValue({ commit }, newValue) {
    commit('SET_INIT_VALUE', newValue);
  },
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters,
}
