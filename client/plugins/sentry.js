export default ({ app, store }) => {
  if (!store.state.auth0.auth0User || !store.getters['auth0/userId']) {
    return
  }

  app.$sentry.configureScope((scope) => {
    scope.setUser({
      id: store.getters['auth0/userId'],
    })
  })
}
