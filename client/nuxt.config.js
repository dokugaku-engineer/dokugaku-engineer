require("dotenv").config()

import axios from "axios"
import qs from 'qs'

export default {
  mode: "spa",
  /*
   ** Headers of the page
   */
  head: {
    title: process.env.npm_package_name || "",
    meta: [{
        charset: "utf-8"
      },
      {
        name: "viewport",
        content: "width=device-width, initial-scale=1, minimum-scale=1"
      },
      {
        hid: "description",
        name: "description",
        content: process.env.npm_package_description || ""
      },
      {
        "http-equiv": "X-UA-Compatible",
        content: "IE=edge"
      },
      {
        name: "twitter:card",
        content: "summary_large_image"
      }
    ],
    script: [{
      src: "https://kit.fontawesome.com/381734123f.js",
      crossorigin: "anonymous"
    }],
    link: []
  },
  /*
   ** Customize the progress-bar color
   */
  loading: {
    color: "#fff"
  },
  /*
   ** Plugins to load before mounting the App
   */
  plugins: [
    "./plugins/axios.js",
    "./plugins/mixins/validation.js",
    "./plugins/vuelidate.js",
    "./plugins/auth0.js",
    "./plugins/click-outside.js",
  ],
  /*
   ** Nuxt.js dev-modules
   */
  buildModules: ["@nuxtjs/dotenv"],
  /*
   ** Nuxt.js modules
   */
  modules: [
    "@nuxtjs/axios",
    "@nuxtjs/style-resources",
    '@nuxtjs/toast',
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
    'AUTH0_AUDIENCE': process.env.AUTH0_AUDIENCE,
    'AUTH0_CLIENT_ID': process.env.AUTH0_CLIENT_ID,
    'AUTH0_DOMAIN': process.env.AUTH0_DOMAIN,
    'AUTH0_NAMESPACE': process.env.AUTH0_NAMESPACE,
    'ORIGIN': process.env.ORIGIN,
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
        audience: process.env.AUTH0_MANAGEMENT_API_AUDIENCE
      };
      const options = {
        method: 'POST',
        headers: {
          'content-type': 'application/x-www-form-urlencoded'
        },
        data: qs.stringify(data),
        url: `https://${process.env.AUTH0_DOMAIN}/oauth/token`,
      }
      const access_token = await axios(options)
        .then((res) => {
          return res['data']['access_token']
        })

      const authorizationOptions = {
        headers: {
          Authorization: `Bearer ${access_token}`
        }
      }

      let courses = axios.get(`${process.env.API_URL}/courses`, authorizationOptions)
        .then((res) => {
          return res.data.map((course) => {
            return '/course/' + course.name
          })
        })
        .catch(err => {
          console.log(err.response)
        })

      let lectures = axios.get(`${process.env.API_URL}/courses/lectures`, authorizationOptions)
        .then((res) => {
          let courseLectures = []
          res.data.forEach(course => {
            course.parts.forEach(part => part.lessons.forEach(lesson => lesson.lectures.forEach(lecture => {
              courseLectures.push('/course/' + course.name + '/lecture/' + lecture.slug)
            })))
          })
          return courseLectures
        })
        .catch(err => {
          console.log(err.response)
        })

      return Promise.all([courses, lectures]).then(values => {
        return [...values[0], ...values[1]]
      })
    }
  },
  /*
   ** Global CSS
   */
  css: ["ress/dist/ress.min.css", "~assets/styles/app.scss"],
  /*
   ** Global CSS variables
   */
  styleResources: {
    scss: ["~assets/styles/variables.scss"]
  },
  axios: {},
  dotenv: {},
  toast: {
    position: 'top-right',
    register: [{
      name: 'instant_success',
      message: payload => {
        if (!payload.message) return '保存しました'
        return payload.message
      },
      options: {
        type: 'success',
        duration: 3000,
        className: ['toast-success']
      }
    }]
  }
}