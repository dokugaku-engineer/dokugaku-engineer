<template>
  <div>
    <transition name="fade">
      <div v-if="showModal" class="modal">
        <div class="loading">
          <i class="fad fa-spinner fa-spin fa-lg" />
        </div>
      </div>
    </transition>
  </div>
</template>

<style lang="scss" scoped>
.modal {
  background-color: rgba(0, 0, 0, 0.6);
  height: 100vh;
  left: 0;
  overflow: hidden;
  position: fixed;
  top: 0;
  width: 100vw;
  z-index: 2000;
}

.loading {
  color: $color-white1;
  left: 47%;
  position: absolute;
  top: 40%;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.1s ease-out;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>

<script>
export default {
  props: {
    showModal: {
      type: Boolean,
      default: false,
    },
  },
}
</script>
