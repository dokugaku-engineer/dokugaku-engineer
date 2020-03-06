import Vue from "vue"
import createAuth0Client from "@auth0/auth0-spa-js"

const DEFAULT_REDIRECT_CALLBACK = () =>
  window.history.replaceState({}, document.title, window.location.pathname);

let instance;

const useAuth0 = async (store, {
  onRedirectCallback = DEFAULT_REDIRECT_CALLBACK,
  redirectUri = window.location.origin,
  ...options
}) => {
  if (instance) return instance


  const auth0Client = await createAuth0Client({
    domain: options.domain,
    client_id: options.clientId,
    audience: options.audience,
    scope: options.scope,
    redirect_uri: redirectUri
  })

  instance = new Vue({
    data() {
      return {
        loading: true,
        isAuthenticated: false,
        user: {},
        auth0Client: null,
        error: null
      }
    },
    methods: {
      async loginWithPopup(options) {
        store.commit('auth0/SET_POPUP_OPEN', true)

        try {
          await this.auth0Client.loginWithPopup(options)
        } finally {
          store.commit('auth0/SET_POPUP_OPEN', false)
        }

        store.commit('auth0/SET_USER', await this.auth0Client.getUser())
        store.commit('auth0/SET_IS_AUTHENTICATED', true)
      },
      async handleRedirectCallback() {
        store.commit('auth0/SET_LOADING', true)

        try {
          await this.auth0Client.handleRedirectCallback()
          store.commit('auth0/SET_USER', await this.auth0Client.getUser())
          store.commit('auth0/SET_IS_AUTHENTICATED', true)
        } finally {
          store.commit('auth0/SET_LOADING', false)
        }
      },
      loginWithRedirect(options) {
        return this.auth0Client.loginWithRedirect(options);
      },
      getIdTokenClaims(options) {
        return this.auth0Client.getIdTokenClaims(options);
      },
      getTokenSilently(options) {
        return this.auth0Client.getTokenSilently(options);
      },
      async getTokenWithPopup(options) {
        store.commit('auth0/SET_POPUP_OPEN', true)

        try {
          const token = await this.auth0Client.getTokenWithPopup(options)
          return token
        } finally {
          store.commit('auth0/SET_POPUP_OPEN', false)
        }
      },
      logout(options) {
        store.commit('auth0/SET_IS_AUTHENTICATED', false)
        return this.auth0Client.logout(options)
      }
    },
    async created() {
      this.auth0Client = auth0Client

      try {
        if (
          window.location.search.includes("code=") &&
          window.location.search.includes("state=")
        ) {
          const {
            appState
          } = await this.auth0Client.handleRedirectCallback()
          onRedirectCallback(appState)
        }
      } finally {
        store.commit('auth0/SET_IS_AUTHENTICATED', await this.auth0Client.isAuthenticated())
        store.commit('auth0/SET_USER', await this.auth0Client.getUser())
        store.commit('auth0/SET_LOADING', false)
      }
    }
  })

  return instance
}

export default async function (context, inject) {
  const options = {
    domain: context.env.AUTH0_DOMAIN,
    clientId: context.env.AUTH0_CLIENT_ID,
    audience: context.env.AUTH0_AUDIENCE,
    scope: context.env.AUTH0_SCOPE,
    onRedirectCallback: (appState) => {
      context.app.router.push(
        appState && appState.targetUrl ?
        appState.targetUrl :
        window.location.pathname
      )
    }
  }

  const auth0 = await useAuth0(context.store, options)

  inject('auth0', auth0)
}