<template>
  <div class="container">
    <logged-in-header v-if="isAuthenticated" :title="title" />
    <logged-out-header v-else />

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
import LoggedOutHeader from "@/components/layouts/LoggedOutHeader.vue"
import NuiFooter from "@/components/layouts/Footer.vue"
import { mapState } from "vuex"

export default {
  components: {
    LoggedInHeader,
    LoggedOutHeader,
    NuiFooter,
  },
  computed: {
    ...mapState(["title"]),
    ...mapState("auth0", ["isAuthenticated"]),
  },
}
</script>
