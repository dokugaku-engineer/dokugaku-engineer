require("dotenv").config()

import axios from "axios"

export default {
  mode: "universal",
  /*
   ** Headers of the page
   */
  head: {
    title: process.env.npm_package_name || "",
    meta: [
      {
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
    script: [
      {
        src: "https://kit.fontawesome.com/381734123f.js",
        crossorigin: "anonymous"
      }
    ],
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
    "./plugins/vuelidate.js"
  ],
  /*
   ** Nuxt.js dev-modules
   */
  buildModules: ["@nuxtjs/dotenv"],
  /*
   ** Nuxt.js modules
   */
  modules: ["@nuxtjs/axios", "@nuxtjs/style-resources"],
  /*
   ** Build configuration
   */
  build: {
    /*
     ** You can extend webpack config here
     */
    extend() {}
  },
  /*
   ** Generate configuration
   */
  generate: {},
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
  dotenv: {}
  // router: {
  //   middleware: "stats"
  // }
}
