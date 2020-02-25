export const state = () => ({
  name: ''
})

export const mutations = {
  SET_NAME(state, name) {
    state.name = name
  }
}

export const actions = {
  setName({
    commit
  }, name) {
    commit("SET_NAME", name)
  }
}