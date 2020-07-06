<template>
  <header class="header">
    <h1>{{ title }}</h1>
  </header>
</template>

<style lang="scss" scoped>
.header {
  font-size: $font-size-xxxl;
  padding-bottom: 40px;
}
</style>

<script>
export default {
  props: {
    title: {
      type: String,
      default: '',
    },
  },
}
</script>
