<template>
  <div>
    <slot />
  </div>
</template>

<style lang="scss" scoped>
.form-group {
  margin-bottom: 2.4rem;

  label {
    font-size: $font-size-sm;
    font-weight: 600;
  }

  input {
    border: 1px solid $color-gray1;
    border-radius: 0.4rem;
    color: $color-black;
    margin-top: 0.8rem;
    max-height: 3.2rem;
    padding: 2rem 0.8rem 2rem;
    width: 100%;
  }
}

.form-require {
  background: $color-red1;
  margin: 0 0 0 0.8rem;
  padding: 0.2rem 0.4rem;
  border-radius: 0.2rem;
  color: #fff;
  font-size: $font-size-xs;
  vertical-align: top;
}

.form-btn {
  margin-top: 3.2rem;

  .btn {
    width: 100%;
  }
}

.form-two-btns {
  display: flex;
  justify-content: space-between;
  margin-top: 3.2rem;

  .btn {
    width: 48%;
  }
}

.error-box {
  background-color: $color-red3;
  border-radius: 0.4rem;
  color: $color-red1;
  font-size: $font-size-sm;
  font-weight: 700;
  margin-bottom: 3.5rem;
  padding: 1.5rem 3rem;
}

.error-box-disc {
  list-style-type: disc;
}

.error-text {
  color: $color-red1;
  font-size: $font-size-sm;
  margin-top: 0.8rem;
}
</style>

<script>
export default {}
</script>
