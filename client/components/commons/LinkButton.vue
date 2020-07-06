<template>
  <n-link :to="to" class="btn">
    <slot />
  </n-link>
</template>

<style lang="scss" scoped>
.btn {
  border: 1px solid transparent;
  border-radius: 6px;
  box-sizing: border-box;
  display: inline-block;
  line-height: 1.5;
  padding: 1.2rem 2rem;
  text-align: center;
}

.btn-xs {
  font-size: $font-size-xs;
}

.btn-red1 {
  background-color: $color-red1;
  border-color: $color-red1;
  color: $color-white1;
}

.btn-outline-teal1 {
  border-color: $color-teal1;
  color: $color-teal1;
}
</style>

<script>
export default {
  props: {
    to: {
      type: String,
      default: '',
    },
  },
}
</script>
