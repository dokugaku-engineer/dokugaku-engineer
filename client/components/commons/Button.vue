<template>
  <button class="btn" :type="submit ? 'submit' : ''" @click="$emit('on-click')">
    <slot />
  </button>
</template>

<style lang="scss" scoped>
.btn {
  border: 1px solid transparent;
  border-radius: 0.6rem;
  box-sizing: border-box;
  display: inline-block;
  line-height: 1.5;
  padding: 1.2rem 2rem;
  text-align: center;
  vertical-align: middle;

  &:focus {
    outline: 0;
  }

  &:disabled {
    color: $color-disabled2;
    background-color: $color-disabled1;
    border-color: $color-disabled1;
  }
}

.btn-xs {
  border-radius: 0.4rem;
  font-size: $font-size-xs;
}

.btn-lg {
  font-size: $font-size-xs;
}

.btn-red1 {
  background-color: $color-red1;
  border-color: $color-red1;
  color: $color-white1;
}

.btn-teal1 {
  background-color: $color-teal1;
  border-color: $color-teal1;
  color: $color-white1;
}

.btn-outline-teal1 {
  border-color: $color-teal1;
  color: $color-teal1;
}

.btn-outline-red1 {
  border-color: $color-red1;
  color: $color-red1;
}

.btn-outline-blue {
  border-color: $color-blue;
  color: $color-blue;
}

.btn-outline-purple {
  border-color: $color-purple;
  color: $color-purple;
}

.btn-shadow {
  box-shadow: 8px 10px 20px 0 rgba(46, 61, 73, 0.15);
}

.btn-shadow-all {
  box-shadow: 0 0 8px 0 rgba(17, 22, 26, 0.16),
    0 4px 8px 0 rgba(17, 22, 26, 0.08), 0 8px 16px 0 rgba(17, 22, 26, 0.08);
}
</style>

<script>
export default {
  props: {
    submit: {
      type: Boolean,
      default: false,
    },
  },
}
</script>
