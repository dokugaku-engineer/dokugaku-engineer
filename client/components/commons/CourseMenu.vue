<template>
  <div>
    <i @click="showMenu = !showMenu" class="far fa-bars bars"></i>
    <transition name="fade">
      <div v-if="showMenu" class="menu">
        <i @click="showMenu = !showMenu" class="fal fa-times fa-lg cross"></i>
        <div class="menu-inner">
          <slot />
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

.cross {
  color: $color-red1;
  margin: 1.5rem 1rem .5rem;
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