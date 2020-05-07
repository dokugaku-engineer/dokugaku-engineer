<template>
  <div class="container">
    <logged-in-header v-if="isAuthenticated" ref="header" :title="title" />
    <nui-header v-else ref="header" />

    <div :style="marginTop">
      <nuxt />
    </div>

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
import debounce from "lodash/debounce"

export default {
  components: {
    LoggedInHeader,
    NuiHeader,
    NuiFooter,
  },
  data() {
    return {
      headerHeight: 0,
    }
  },
  computed: {
    ...mapState(["title"]),
    ...mapState("auth0", ["isAuthenticated"]),
    marginTop() {
      return `margin-top: ${this.headerHeight}px;`
    },
  },
  mounted() {
    this.headerHeight = this.$refs.header.$el.clientHeight
    window.addEventListener("resize", this.handleResize)
  },
  beforeDestroy() {
    window.removeEventListener("resize", this.handleResize)
  },
  methods: {
    handleResize: debounce(function () {
      this.headerHeight = this.$refs.header.$el.clientHeight
    }, 300),
  },
}
</script>
