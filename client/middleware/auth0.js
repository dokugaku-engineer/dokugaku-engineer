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
      env,
      redirect,
      store
    }) => {
      const isAuthenticated = store.state.auth0.isAuthenticated
      const user = store.state.auth0.user

      // 未ログインの場合
      if (options.loginRequired && !isAuthenticated) {
        return redirect('/')
      }

      // 会員情報が未登録の場合
      if (isAuthenticated && !!user && !user[env.AUTH0_NAMESPACE + 'user_id']) {
        return redirect('/registration')
      }

      // 権限がない場合
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

      // ログイン済みの場合
      if (options.authenticatedRedirectUri && isAuthenticated) {
        return redirect(options.authenticatedRedirectUri)
      }
    }
  },
  // registrationページを保護する
  protectRegistration() {
    return ({
      env,
      redirect,
      store
    }) => {
      const isAuthenticated = store.state.auth0.isAuthenticated
      const user = store.state.auth0.user

      // 未ログインの場合
      if (!isAuthenticated) {
        return redirect('/')
      }

      // 登録済みの場合
      if (!!user && !!user[env.AUTH0_NAMESPACE + 'user_id']) {
        return redirect('/course/serverside')
      }
    }
  }
}