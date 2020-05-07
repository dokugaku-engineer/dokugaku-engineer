<template>
  <div class="wrap">
    <header class="l-header">
      <h1>
        <logo />
      </h1>
    </header>
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

.l-header {
  background-color: $color-white1;
  padding: 10px 0 2px;
  text-align: center;
}

@media screen and (min-width: 769px) {
  .l-header {
    padding: 17px 0 10px;
  }
}

.l-header-logo {
  width: 170px;
}

@media screen and (min-width: 769px) {
  .l-header-logo {
    width: 222px;
  }
}

.footer_wrap {
  margin-top: auto;
}
</style>

<script>
import Logo from "@/components/svg/Logo.vue"
import NuiFooter from "@/components/layouts/Footer.vue"

export default {
  components: {
    Logo,
    NuiFooter,
  },
}
</script>
