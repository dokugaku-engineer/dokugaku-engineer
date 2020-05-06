<template>
  <div class="container">
    <logged-in-header v-if="isAuthenticated" :title="title" />
    <nui-header v-else />

    <nuxt />

    <div class="footer_wrap">
      <nui-footer />
    </div>
  </div>
</template>

<style lang="scss" scoped>
.container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  overflow-x: hidden;
}

.footer_wrap {
  margin-top: auto;
}
</style>

<script>
import LoggedInHeader from "@/components/layouts/LoggedInHeader.vue"
import NuiHeader from "@/components/layouts/Header.vue"
import NuiFooter from "@/components/layouts/Footer.vue"
import { mapState } from "vuex"

export default {
  components: {
    LoggedInHeader,
    NuiHeader,
    NuiFooter,
  },
  computed: {
    ...mapState(["title"]),
    ...mapState("auth0", ["isAuthenticated"]),
  },
}
</script>
