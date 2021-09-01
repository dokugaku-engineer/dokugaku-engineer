import Vue from 'vue'

Vue.filter('local-price', function (value) {
  return Number(value).toLocaleString();
});
