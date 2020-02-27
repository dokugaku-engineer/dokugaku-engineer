<template>
  <div class="container">
    <header class="header fixed-top bg-white1">
      <nuxt-link to="/" class="header-logo">
        <logo />
      </nuxt-link>
      <div>
        <i @click="showMenu = !showMenu" class="far fa-bars fa-lg bars"></i>
        <transition name="fade">
          <div v-if="showMenu" class="menu">
            <div class="cross-container">
              <i @click="showMenu = !showMenu" class="fal fa-times fa-2x cross"></i>
            </div>
            <div class="menu-inner">
              <ul class="menu-nav">
                <li class="menu-item">
                  <nuxt-link to="/" class="menu-link" @click.native="showMenu = !showMenu">トップ</nuxt-link>
                </li>
                <li>
                  <nuxt-link to="" class="menu-link" @click.native="showMenu = !showMenu">ログイン</nuxt-link>
                </li>
                <li>
                  <nuxt-link to="/course/serverside" class="menu-link" @click.native="showMenu = !showMenu">無料で受講</nuxt-link>
                </li>
              </ul>
            </div>
          </div>
        </transition>
      </div>
      <div class="header-menu">
        <nuxt-link to="" class="header-link">ログイン</nuxt-link>
        <nuxt-link to="/course/serverside">
          <nui-button class="btn-teal1 btn-xs btn-shadow-all header-link header-btn">無料で受講</nui-button>
        </nuxt-link>
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
  align-items: center;
  box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
  display: flex;
  padding: 1.6rem .8rem 1rem 2rem;
}

@media screen and (min-width: 769px) {
  .header {
    padding: 2rem 3.2rem;
  }
}

.header-menu {
  display: none;
}

@media screen and (min-width: 769px) {
  .header-menu {
    display: block;
    text-align: right;
    width: 100%;
  }
}

.header-logo {
  width: 100%;
}

.header-link {
  font-size: $font-size-sm;
  letter-spacing: .2rem;
  margin: 0 1.6rem;
}

.header-btn {
  font-weight: 700;
  height: 3.2rem;
  line-height: 3.2rem;
  min-width: 12rem;
  padding: 0 1rem;
  text-align: center;
}

.bars {
  color: $color-red1;
  display: block;
  margin-right: 1rem;
}

@media screen and (min-width: 769px) {
  .bars {
    display: none;
  }
}

.cross-contaier {
  display: flex;
}

.cross {
  color: $color-red1;
  display: block;
  position: relative;
  margin: 2rem 1.8rem 0 0;
  text-align: right;
}

.menu {
  background-color: rgb(255, 255, 255) !important;
  bottom: 0px !important;
  height: 100% !important;
  left: 0px !important;
  position: fixed !important;
  right: 0px !important;
  top: 0px !important;
  z-index: 10 !important;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .3s ease-out;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}

.menu-inner {
  padding: 2rem;
  text-align: center;
}

.menu-nav {
  display: flex;
  flex-direction: column;
}

.menu-link {
  display: block;
  font-weight: 700;
  margin: .8rem .4rem;
  padding: .8rem 0;
}

</style>

<script>
import Logo from "@/components/svg/Logo.vue"
import NuiButton from "@/components/commons/Button.vue"
import Footer from "@/components/layouts/Footer.vue"


export default {
  components: {
    Logo,
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
