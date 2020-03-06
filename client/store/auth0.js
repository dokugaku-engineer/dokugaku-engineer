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