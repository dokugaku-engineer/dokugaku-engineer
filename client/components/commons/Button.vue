<template>
  <button class="btn" :type="submit ? 'submit' : ''" @click="$emit('on-click')">
    <slot />
  </button>
</template>

<style lang="scss" scoped>
.btn {
  border: 1px solid transparent;
  border-radius: 6px;
  box-sizing: border-box;
  display: inline-block;
  line-height: 1.5;
  padding: 0.5rem 2rem;
  text-align: center;

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
</style>

<script>
export default {
  props: {
    submit: {
      type: Boolean,
      default: false
    }
  }
}
</script>
