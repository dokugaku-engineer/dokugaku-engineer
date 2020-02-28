<template>
  <div class="container">
    <header class="header fixed-top">
      <nuxt-link to="/" class="header-logo">
        <logo />
      </nuxt-link>
      <nuxt-link to="/" class="header-item header-logo-short">
        <logo-short />
      </nuxt-link>
      <div class="header-item">
        <div class="header-menu">
          <nuxt-link to="" class="header-link">ログイン</nuxt-link>
          <nuxt-link to="/course/serverside">
            <nui-button class="btn-teal1 btn-xs btn-shadow-all header-link header-btn">無料で受講</nui-button>
          </nuxt-link>
        </div>
      </div>
    </header>

    <nuxt />

    <Footer />
  </div>
</template>

<style lang="scss" scoped>
.container {
  overflow-x: hidden;
}

.header {
  background-color: rgba(255,255,255,0.95);
  box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
  display: flex;
  justify-content: flex-end;
  padding: 1.6rem .8rem 1.2rem 2rem;
}

@media screen and (min-width: 769px) {
  .header {
    padding: 2rem 3.2rem;
  }
}

.header-item {
  align-items: center;
  display: flex;
}

.header-menu {
  display: block;
  text-align: right;
}

.header-logo {
  display: none;
}

@media screen and (min-width: 769px) {
  .header-logo {
    display: block;
    margin-right: auto;
  }
}

.header-logo-short {
  margin-right: auto;
}

@media screen and (min-width: 769px) {
  .header-logo-short {
    display: none;
  }
}

.header-link {
  font-size: $font-size-sm;
  letter-spacing: .2rem;
  margin: 0 .8rem;
}

@media screen and (min-width: 769px) {
  .header-link {
    margin: 0 1.6rem;
  }
}

.header-btn {
  font-weight: 700;
  height: 3.2rem;
  line-height: 3.2rem;
  min-width: 12rem;
  padding: 0 1rem;
  text-align: center;
}

@media screen and (min-width: 769px) {
  .header-btn {
  }
}

.fixed-top {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  z-index: 10;
}
</style>

<script>
import Logo from "@/components/svg/Logo.vue"
import LogoShort from "@/components/svg/LogoShort.vue"
import NuiButton from "@/components/commons/Button.vue"
import Footer from "@/components/layouts/Footer.vue"


export default {
  components: {
    Logo,
    LogoShort,
    NuiButton,
    Footer
  },
  data() {
    return {
      showMenu: false
    }
  }
}
</script>
