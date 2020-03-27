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
      console.log(30)

      const isAuthenticated = store.state.auth0.isAuthenticated
      const user = store.state.auth0.auth0User

      // 未ログインの場合
      if (options.loginRequired && !isAuthenticated) {
        console.log(31)
        return redirect('/')
      }

      // 会員情報が未登録の場合
      if (isAuthenticated && !!user && !user[env.AUTH0_NAMESPACE + 'user_id']) {
        console.log(32)
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
          console.log(33)
          return redirect('/')
        }
      }

      // ログイン済みの場合
      if (options.authenticatedRedirectUri && isAuthenticated) {
        console.log(34)
        return redirect(options.authenticatedRedirectUri)
      }

      console.log(35)
    }
  },
  // registrationページを保護する
  protectRegistration() {
    return ({
      env,
      redirect,
      store
    }) => {
      console.log(36)
      console.log(store.state.auth0)
      console.log(store.state.auth0.isAuthenticated)
      const isAuthenticated = store.state.auth0.isAuthenticated
      const user = store.state.auth0.auth0User

      // 未ログインの場合
      if (!isAuthenticated) {
        console.log(37)
        return redirect('/')
      }

      // 登録済みの場合
      if (!!user && !!user[env.AUTH0_NAMESPACE + 'user_id']) {
        console.log(38)
        return redirect('/course/serverside')
      }

      console.log(39)
    }
  }
}