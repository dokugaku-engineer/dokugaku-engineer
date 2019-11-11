<template>
  <div class="container">
    <div
      class="p-blog-hero"
      style="background-image:url('https://saruwakakun.com/wp-content/uploads/2017/06/dadadada-09-886x600.png');"
    >
      <div class="p-blog-hero__cover">
        <div class="p-blog-hero__inner">
          <div class="p-blog-hero__metadata">
            <a href="">Twitter API</a>
            <span>&ensp;|&ensp;2019-09-22</span>
          </div>
          <div class="p-blog-hero__title">
            head内に書くべきタグを総まとめ：SEO対策に有効なものは？
            <br />
            <a class="c-btn p-blog-hero_btn" href="">もっと読む</a>
          </div>
        </div>
      </div>
    </div>
    <div class="p-blog__content clearfix">
      <main class="p-blog__main">
        <Article />
      </main>
      <sidebar />
    </div>
  </div>
</template>

<style lang="scss" scoped>
.container {
  background-color: $color-white2;
}

.c-btn {
  border-radius: 4px;
  cursor: pointer;
  display: inline-block;
  text-align: center;
  touch-action: manipulation;
  transition: background 0.3s ease 0s;
  user-select: none;
  vertical-align: middle;
}

.c-btn:hover {
  background: $color-red2 none repeat scroll 0 0;
}

@media screen and (min-width: 768px) {
  .p-blog__content {
    margin: 0 auto 20px;
    max-width: 1230px;
    padding: 0 15px;
  }
}

.p-blog__main {
  float: none;
  padding: 0 3vw;
  width: 100%;
}

@media screen and (min-width: 768px) {
  .p-blog__main {
    float: left;
    width: 67%;
  }
}

.p-blog-hero {
  background-size: cover;
  background-position: center;
  display: block;
  margin-bottom: 5vw;
  width: 100%;
}

@media screen and (min-width: 768px) {
  .p-blog-hero {
    margin-bottom: 60px;
  }
}

.p-blog-hero__cover {
  background: rgba(46, 61, 73, 0.6);
}

.p-blog-hero__inner {
  margin-left: auto;
  margin-right: auto;
  padding-left: 30px;
  padding-right: 30px;
  color: #fff;
}

@media screen and (min-width: 768px) {
  .p-blog-hero__inner {
    width: 750px;
  }
}

.p-blog-hero__metadata {
  font-size: $font-size-xs;
  letter-spacing: 0.1em;
  padding: 70px 0 15px 0;
  text-align: center;
  font-weight: 500;
}

.p-blog-hero__title {
  font-size: 2.4rem;
  font-weight: 700;
  padding: 20px 0 20px 0;
  line-height: 1.5;
  text-align: justify;
  word-wrap: break-word;
  letter-spacing: 0.1em;
}

@media screen and (min-width: 768px) {
  .p-blog-hero__title {
    font-size: 2.8rem;
    max-width: 80%;
    margin: 0px auto;
  }
}

.p-blog-hero_btn {
  background: $color-red1;
  display: block;
  font-size: $font-size-sm;
  font-weight: 600;
  letter-spacing: 1.25px;
  margin: 40px auto 20px;
  max-width: 300px;
  padding: 1em 0.25em;
  width: auto;
}

@media screen and (min-width: 768px) {
  .p-blog-hero_btn {
    margin: 40px auto 40px;
  }
}
</style>

<script>
import Article from "@/components/partials/blog/Article.vue"
import Sidebar from "@/components/partials/blog/Sidebar.vue"

export default {
  layout: "blog",
  components: {
    Article,
    Sidebar
  }
}
</script>
