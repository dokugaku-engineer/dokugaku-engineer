<template>
  <div class="static-page">
    <div class="static-wrapper">
      <div class="static-content">
        <slot />
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.static-page {
  background-color: $color-white2;
  display: flex;
  flex-direction: column;
  min-height: 90vh;

  h1 {
    font-size: $font-size-xxxl;
    font-weight: 700;
    margin-top: 4rem;
    margin-bottom: 4rem;
    text-align: center;
  }

  h3 {
    font-size: $font-size-lg;
    font-weight: 700;
    margin: 4rem 0 2rem;
  }

  p {
    line-height: 1.5;
  }

  ol {
    counter-reset: count;
  }

  ol.period-num > li {
    list-style-position: inside;
    line-height: 1.5;
    margin-bottom: 1rem;

    &:before {
      counter-increment: count;
      content: counter(count) ". ";
    }
  }

  ol.brackets-num > li:before {
    counter-increment: count;
    content: "(" counter(count) ") ";
  }
}

.static-wrapper {
  margin: 0 auto;
  max-width: 960px;
  padding-bottom: 6rem;
  width: 80%;
}

@media screen and (min-width: 769px) {
  .static-page {
    h1 {
      margin-top: 0;
    }
  }

  .static-wrapper {
    padding-top: 4rem;
  }

  .static-content {
    background-color: $color-white1;
    padding: 5.6rem;
  }
}

.revision {
  margin: 40px 0 0;
  text-align: right;
  list-style-type: none;
}
</style>

<script>
export default {}
</script>
