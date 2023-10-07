<template>
  <div class="container">
    <div v-if="[403, 404].indexOf(error.statusCode) >= 0" class="error">
      <h2 class="error-title">Page Not Found</h2>
      <p class="error-code">404</p>
      <p class="error-message">お探しのページは見つかりませんでした。</p>
    </div>
    <div v-else class="error">
      <h2 class="error-title">Error Found</h2>
      <p class="error-code">
        {{ error.statusCode }}
      </p>
      <p class="error-message">エラーが発生しました。</p>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.container {
  background-color: $color-white2;
  padding: 6.4rem 1rem 10rem;
}

@media screen and (min-width: 769px) {
  padding: 9.6rem 4rem 12rem;
}

.error {
  margin-left: auto;
  margin-right: auto;
  text-align: center;
}

.error-title {
  font-size: 2.8rem;
  margin-top: 6.4rem;
}

@media screen and (min-width: 769px) {
  .error-title {
    font-size: 4.8rem;
  }
}

.error-code {
  font-size: 12rem;
  font-weight: 700;
  line-height: 14rem;
}

@media screen and (min-width: 769px) {
  .error-code {
    font-size: 19rem;
    line-height: 21rem;
  }
}

.error-message {
  font-size: $font-size-sm;
}

@media screen and (min-width: 769px) {
  .error-message {
    font-size: $font-size-base;
  }
}
</style>

<script>
export default {
  props: {
    error: {
      type: Object,
      default: () => ({}),
    },
  },
}
</script>
