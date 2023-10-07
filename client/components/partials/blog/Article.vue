<template>
  <div class="p-blog-article-list">
    <a href="" class="p-blog-article-list__article">
      <article class="p-blog-article-list__article-inner">
        <img
          class="p-blog-article-list__article-image"
          src="https://saruwakakun.com/wp-content/uploads/2017/05/gad-200x200.png"
          alt=""
        />
        <div class="p-blog-article-list__article-texts">
          <h2 class="p-blog-article-list__article-title">
            WEBサイトの仕組みを丁寧に基礎から学ぼう
          </h2>
          <time class="p-blog-article-list__article-date"> 2019-09-22 </time>
        </div>
      </article>
    </a>
    <a href="" class="p-blog-article-list__article">
      <article class="p-blog-article-list__article-inner">
        <img
          class="p-blog-article-list__article-image"
          src="https://saruwakakun.com/wp-content/uploads/2017/05/gad-200x200.png"
          alt=""
        />
        />
        <div class="p-blog-article-list__article-texts">
          <h2 class="p-blog-article-list__article-title">
            WEBサイトの仕組みを丁寧に基礎から学ぼう
          </h2>
          <time class="p-blog-article-list__article-date"> 2019-09-22 </time>
        </div>
      </article>
    </a>
    <a href="" class="p-blog-article-list__article">
      <article class="p-blog-article-list__article-inner">
        <img
          class="p-blog-article-list__article-image"
          src="https://saruwakakun.com/wp-content/uploads/2017/05/gad-200x200.png"
          alt=""
        />
        <div class="p-blog-article-list__article-texts">
          <h2 class="p-blog-article-list__article-title">
            WEBサイトの仕組みを丁寧に基礎から学ぼう
          </h2>
          <time class="p-blog-article-list__article-date"> 2019-09-22 </time>
        </div>
      </article>
    </a>
  </div>
</template>

<style lang="scss" scoped>
.p-blog-article-list {
  display: block;
  margin: 14px 0 0;
}

@media screen and (min-width: 769px) {
  .p-blog-article-list {
    display: flex;
    flex-wrap: wrap;
    -webkit-box-pack: justify;
    justify-content: space-between;
    margin: 0 -1% 0;
  }
}

.p-blog-article-list__article {
  background-color: $color-white1;
  box-shadow: 5px 5px 25px 0 rgba(46, 61, 73, 0.2);
  display: block;
  margin: 0 0 14px;
  padding: 10px;
  transition: all 0.3s ease;
}

.p-blog-article-list__article:hover {
  box-shadow: 2px 4px 8px 0 rgba(46, 61, 73, 0.2);
}

@media screen and (min-width: 769px) {
  .p-blog-article-list__article {
    width: 48%;
    margin: 0 1% 17px;
  }
}

.p-blog-article-list__article-inner {
  display: flex;
  align-items: center;
}

.p-blog-article-list__article-image {
  width: 100px;
  height: 100px;
  object-fit: cover;
}

@media screen and (min-width: 1201px) {
  .p-blog-article-list__article-image {
    width: 120px;
    height: 120px;
  }
}

.p-blog-article-list__article-texts {
  padding-left: 10px;
  flex: 1 1 0%;
}

@media screen and (min-width: 769px) {
  .p-blog-article-list__article-texts {
    padding-left: 10px;
  }
}

.p-blog-article-list__article-title {
  font-size: $font-size-base;
  line-height: 1.4;
}

.p-blog-article-list__article-date {
  font-size: $font-size-xs;
  margin-top: 5px;
  line-height: 1;
  color: $color-gray2;
}
</style>
