<template>
  <aside class="p-blog__sidebar">
    <div class="p-blog-aside">
      <h4 class="p-blog-aside__title">
        書いている人
      </h4>
      <div class="p-blog-aside__writer clearfix">
        <img
          class="p-blog-aside__writer-img"
          src="@/assets/images/profile.jpg"
          alt=""
        />
        <dl class="p-blog-aside__writer-profile">
          <dt class="p-blog-aside__writer-name">
            山浦　清透
          </dt>
          <dd class="p-blog-aside__writer-detail">
            未経験からエンジニアに転向した経験を元に、プログラミングの学習方法や知っておきたいインターネットの知識をまとめています。
          </dd>
        </dl>
      </div>
    </div>
  </aside>
</template>

<style lang="scss" scoped>
.p-blog__sidebar {
  float: none;
  width: 100%;
}

@media screen and (min-width: 768px) {
  .p-blog__sidebar {
    float: right;
    width: 29%;
  }
}

.p-blog-aside {
  background-color: $color-white1;
  float: none;
  margin-bottom: 30px;
  line-height: 1.6;
  font-size: $font-size-sm;
  width: 100%;
}

.p-blog-aside__title {
  background-color: $color-teal1;
  color: $color-white1;
  font-size: $font-size-lg;
  font-weight: 700;
  padding: 7px 15px;
}

.p-blog-aside__writer {
  padding: 18px 10px;
  color: $color-gray3;
}

.p-blog-aside__writer-img {
  border: solid 2px $color-white2;
  border-radius: 50%;
  float: left;
  width: 30%;
}

.p-blog-aside__writer-profile {
  float: right;
  width: 67%;
}

.p-blog-aside__writer-name {
  font-size: $font-size-sm;
  font-weight: 700;
}

.p-blog-aside__writer-detail {
  font-size: $font-size-xs;
}
</style>
