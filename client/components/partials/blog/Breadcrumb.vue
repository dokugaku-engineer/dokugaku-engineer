<template>
  <nav>
    <ol class="p-blog-breadcrumb">
      <li>
        <a href="">
          <i class="fas fa-home-alt fa-lg" />
          <span>ホーム</span>
        </a>
      </li>
      <li><i class="fas fa-caret-right" /></li>
      <li>カテゴリー</li>
    </ol>
  </nav>
</template>

<style lang="scss" scoped>
.p-blog-breadcrumb {
  color: $color-gray2;
  font-size: $font-size-sm;
  font-weight: 700;
  line-height: 22px;
  padding: 15px 3vw 10px;

  li {
    display: inline-block;
    margin-right: 2px;

    a {
      padding-right: 4px;
    }

    .fa-home-alt {
      color: $color-red1;
      padding-right: 4px;
    }
  }
}

@media screen and (min-width: 769px) {
  .p-blog-breadcrumb {
    font-size: $font-size-base;
    margin-bottom: 10px;
  }
}

.p-blog-breadcrumb__wrap {
  text-align: center;
}

@media screen and (min-width: 769px) {
  .p-blog-breadcrumb__wrap {
    margin-left: 5px;
    text-align: left;

    .p-blog-breadcrumb {
      margin-bottom: 0;
      padding: 15px 0 10px;
    }
  }
}
</style>
