require('dotenv').config()

import axios from 'axios'
import qs from 'qs'

export default {
  mode: 'spa',
  /*
   ** Headers of the page
   */
  head: {
    htmlAttrs: {
      prefix: 'og: http://ogp.me/ns#',
    },
    meta: [
      {
        charset: 'utf-8',
      },
      {
        name: 'viewport',
        content: 'width=device-width, initial-scale=1, minimum-scale=1',
      },
      {
        'http-equiv': 'X-UA-Compatible',
        content: 'IE=edge',
      },
      {
        name: 'twitter:card',
        content: 'summary_large_image',
      },
      {
        name: 'twitter:site',
        content: '@kiyotoyamaura',
      },
      {
        hid: 'og:site_name',
        property: 'og:site_name',
        content: '独学エンジニア',
      },
      {
        hid: 'og:type',
        property: 'og:type',
        content: 'website',
      },
      {
        hid: 'og:url',
        property: 'og:url',
        content: process.env.ORIGIN || 'http://localhost:3333',
      },
      {
        hid: 'og:title',
        property: 'og:title',
        content: '独学エンジニア',
      },
      {
        hid: 'og:image',
        property: 'og:image',
        content: `${process.env.ORIGIN || 'http://localhost:3333'}/og_top.png`,
      },
    ],
    script: [
      {
        src: 'https://kit.fontawesome.com/381734123f.js',
        crossorigin: 'anonymous',
      },
    ],
  },
  /*
   ** Customize the progress-bar color
   */
  loading: {
    color: '#fff',
  },
  /*
   ** Plugins to load before mounting the App
   */
  plugins: [
    './plugins/axios.js',
    './plugins/mixins/validation.js',
    './plugins/vuelidate.js',
    './plugins/auth0.js',
    './plugins/click-outside.js',
    './plugins/sentry.js',
    './plugins/markdownit',
    './plugins/prism',
  ],
  /*
   ** Nuxt.js dev-modules
   */
  buildModules: [
    '@nuxtjs/dotenv',
    '@nuxtjs/stylelint-module',
    '@nuxtjs/google-analytics',
  ],
  /*
   ** Nuxt.js modules
   */
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/style-resources',
    '@nuxtjs/toast',
    '@nuxtjs/sentry',
    '@nuxtjs/markdownit',
    'vue-social-sharing/nuxt',
  ],
  /*
   ** Build configuration
   */
  build: {
    /*
     ** You can extend webpack config here
     */
    quiet: false,
  },
  /*
   ** Env for client side
   */
  env: {
    AUTH0_AUDIENCE: process.env.AUTH0_AUDIENCE,
    AUTH0_CLIENT_ID: process.env.AUTH0_CLIENT_ID,
    AUTH0_DOMAIN: process.env.AUTH0_DOMAIN,
    AUTH0_NAMESPACE: process.env.AUTH0_NAMESPACE,
    ORIGIN: process.env.ORIGIN,
    SENTRY_DSN: process.env.SENTRY_DSN,
    STRIPE_PUBLISHABLE_KEY: process.env.STRIPE_PUBLISHABLE_KEY,
    LOCALE: process.env.LOCALE,
  },
  /*
   ** Generate configuration
   */
  generate: {
    async routes() {
      // Machine to mechine用のアクセストークンを取得する
      const data = {
        grant_type: 'client_credentials',
        client_id: process.env.AUTH0_MANAGEMENT_API_CLIENT_ID,
        client_secret: process.env.AUTH0_MANAGEMENT_API_CLIENT_SECRET,
        audience: process.env.AUTH0_MANAGEMENT_API_AUDIENCE,
      }
      const options = {
        method: 'POST',
        headers: {
          'content-type': 'application/x-www-form-urlencoded',
        },
        data: qs.stringify(data),
        url: `https://${process.env.AUTH0_DOMAIN}/oauth/token`,
      }
      const access_token = await axios(options).then((res) => {
        return res['data']['access_token']
      })

      const authorizationOptions = {
        headers: {
          Authorization: `Bearer ${access_token}`,
        },
      }

      let courses = axios
        .get(`${process.env.API_URL}/courses`, authorizationOptions)
        .then((res) => {
          return res.data.map((course) => {
            return '/course/' + course.name
          })
        })
        .catch((err) => {
          console.log(err.response)
        })

      let lectures = axios
        .get(`${process.env.API_URL}/courses/lectures`, authorizationOptions)
        .then((res) => {
          let courseLectures = []
          res.data.forEach((course) => {
            course.parts.forEach((part) =>
              part.lessons.forEach((lesson) =>
                lesson.lectures.forEach((lecture) => {
                  courseLectures.push(
                    '/course/' + course.name + '/lecture/' + lecture.slug
                  )
                })
              )
            )
          })
          return courseLectures
        })
        .catch((err) => {
          console.log(err.response)
        })

      return Promise.all([courses, lectures]).then((values) => {
        return [...values[0], ...values[1]]
      })
    },
  },
  /*
   ** Global CSS
   */
  css: ['ress/dist/ress.min.css', '~assets/styles/app.scss'],
  /*
   ** Global CSS variables
   */
  styleResources: {
    scss: ['~assets/styles/variables.scss'],
  },
  /*
   * Axios settings
   */
  axios: {},
  /*
   * Dotenv settings
   */
  dotenv: {},
  /*
   * Toast settings
   */
  toast: {
    position: 'top-right',
    register: [
      {
        name: 'instant_success',
        message: (payload) => {
          if (!payload.message) return '保存しました'
          return payload.message
        },
        options: {
          type: 'success',
          duration: 3000,
          className: ['toast-success'],
        },
      },
    ],
  },
  /*
   * Sentry settings
   */
  sentry: {
    dsn: process.env.SENTRY_DSN || false,
    disabled: false,
    disableClientSide: false,
    disableServerSide: true,
    publishRelease: false,
  },
  /*
   * Stylelint settings
   */
  stylelint: {
    fix: true,
  },
  /*
   * Google Analytics settings
   */
  googleAnalytics: {
    id: process.env.GA_TRACKING_ID,
  },
}
