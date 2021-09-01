import Vue from 'vue'

Vue.filter('localprice', function (value) {
  return Number(value).toLocaleString()
})
