<template>
  <div class="wrap">
    <Header />
    <nuxt />
    <div class="footer_wrap">
      <nui-footer />
    </div>
  </div>
</template>

<style lang="scss" scoped>
.wrap {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.footer_wrap {
  margin-top: auto;
}
</style>

<script>
import Header from "@/components/layouts/Header.vue"
import NuiFooter from "@/components/layouts/Footer.vue"

export default {
  components: {
    Header,
    NuiFooter,
  },
}
</script>
