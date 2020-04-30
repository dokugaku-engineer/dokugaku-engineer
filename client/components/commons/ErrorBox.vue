<template>
  <div class="error-box">
    <slot />
  </div>
</template>

<style lang="scss" scoped>
.error-box {
  background-color: $color-red3;
  border-radius: 0.4rem;
  color: $color-red1;
  font-size: $font-size-sm;
  font-weight: 700;
  margin-bottom: 3.5rem;
  padding: 1.5rem 3rem;
}
</style>

<script>
export default {}
</script>
