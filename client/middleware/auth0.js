import intersection from 'lodash/intersection'
import merge from 'lodash/merge'

export default {
  protect(options) {
    options = merge({
      loginRequired: true,
      requiredPermissions: [],
      authenticatedRedirectUri: ''
    }, options)

    return ({
      app,
      redirect,
      store
    }) => {
      if (options.loginRequired && !store.state.auth0.isAuthenticated) {
        return redirect('/')
      }

      if (options.loginRequired && options.requiredPermissions.length > 0) {
        if (
          intersection(
            options.requiredPermissions,
            store.state.auth0.permissions
          ).length !== options.requiredPermissions.length
        ) {
          return redirect('/')
        }
      }

      if (options.authenticatedRedirectUri && store.state.auth0.isAuthenticated) {
        return redirect(options.authenticatedRedirectUri)
      }
    }
  }
}