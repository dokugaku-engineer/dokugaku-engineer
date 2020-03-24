export const state = () => ({
  loading: true,
  isAuthenticated: false,
  user: {},
  popupOpen: false,
  permissions: []
})

export const mutations = {
  SET_LOADING(state, loading) {
    state.loading = !!loading
  },
  SET_IS_AUTHENTICATED(state, isAuthenticated) {
    state.isAuthenticated = !!isAuthenticated
  },
  SET_USER(state, user) {
    state.user = user
  },
  SET_POPUP_OPEN(state, popupOpen) {
    state.popupOpen = !!popupOpen
  },
  SET_PERMISSIONS(state, permissions) {
    state.permissions = permissions
  }
}

export const getters = {
  providers(state) {
    return state.user[process.env.AUTH0_NAMESPACE + 'providers'].map(provider => {
      if (provider == 'github') {
        return 'GitHub'
      } else if (provider == 'twitter') {
        return 'Twitter'
      } else {
        return provider
      }
    })
  },
  userId(state) {
    return state.user[process.env.AUTH0_NAMESPACE + 'user_id']
  }
}