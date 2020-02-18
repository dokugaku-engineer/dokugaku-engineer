<template>
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
              <a href="" class="menu-link">トップ</a>
            </li>
            <li>
              <a href="" class="menu-link">ログイン</a>
            </li>
            <li>
              <a href="" class="menu-link">無料で受講</a>
            </li>
          </ul>
        </div>
      </div>
    </transition>
  </div>
</template>

<style lang="scss" scoped>
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
export default {
  data() {
    return {
      showMenu: false
    }
  }
}
</script>