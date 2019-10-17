<template>
  <h1>Hello! {{ title }}</h1>
</template>

<script>
export default {
  layout: "admin",
  asyncData({ $axios }) {
    return $axios.$get(`http://nginx:80/api/sample`).then(res => {
      return { title: res.title }
    })
  }
}
</script>
