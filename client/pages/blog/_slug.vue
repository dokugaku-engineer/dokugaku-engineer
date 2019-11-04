<template>
  <div class="p-blog__content clearfix">
    <Breadcrumb class="p-blog-breadcrumb__wrap" />
    <main class="p-post__main">
      <header class="p-post__header">
        <div class="p-post__metadata">
          <i class="fas fa-clock fa-lg" />
          <time>
            2019-09-22
          </time>
        </div>
        <h1 class="p-post__title">
          おしゃれなアイキャッチ画像の作り方＆デザインのコツ8つ
        </h1>
      </header>
      <div class="p-post__hero">
        <img
          src="https://saruwakakun.com/wp-content/uploads/2017/07/eyecatch-min-911x600.png"
          alt=""
        />
      </div>
      <div class="p-post__content">
        <p>
          最初は概念的な話になるのでモヤモヤが残るかもしれませんが、読み進めることで理解が深まっていくと思うので焦らず１つずつ理解を積み重ねていきましょう。
        </p>
        <nav class="p-post__contents">
          <div class="p-post__contents-header">
            <i class="fas fa-th-list" />
            <span>記事の目次</span>
          </div>
          <ol class="p-post__contents-list">
            <li><a href="">パンくずリストとは？</a></li>
            <li><a href="">パンくずリストとは？</a></li>
          </ol>
        </nav>
        <h2>パンくずリストとは？</h2>
        <p>
          パンくずリストとは「<strong>現在見ているページがwebサイトのどの階層にいるのかを表す道しるべ</strong>」です。パンくずリストはそのwebサイトのサイトマップ（サイトの階層構造）にもとづいて表されていてます。
        </p>
        <h3>パンくずリストの由来</h3>
        <img
          class=""
          src="https://webliker.info/wp-content/uploads/2018/09/hansel-and-gretel.jpg"
          alt=""
        />
        <p>さて、「パンくずの道しるべ」と聞くとある童話を思い出しますね。</p>
        <h4>ダウンロードができたら…</h4>
        <p>
          ダウンロードしたものは、Google
          Chromeのインストール用のファイルです。このファイルを開いて、インストールをしましょう。
        </p>
        <p>
          ダウンロードしたものは、Google
          Chromeのインストール用のファイルです。このファイルを開いて、インストールをしましょう。
        </p>
        <h2>パンくずリストとは？</h2>
        <h3>パンくずリストの由来</h3>
        <p>さて、「パンくずの道しるべ」と聞くとある童話を思い出しますね。</p>
      </div>
    </main>
    <sidebar />
  </div>
</template>

<style lang="scss" scoped>
@media screen and (min-width: 768px) {
  .p-blog__content {
    margin: 0 auto 20px;
    max-width: 1230px;
    padding: 0 15px;
  }
}

.p-post__main {
  background: $color-white1;
  float: none;
  padding: 0 4vw;
  margin-bottom: 6vw;
  width: 100%;
}

@media screen and (min-width: 768px) {
  .p-post__main {
    float: left;
    margin-bottom: 1vw;
    width: 67%;
  }
}

.p-post__header {
  line-height: 1.8;
  padding: 20px 0 15px;
}

@media screen and (min-width: 768px) {
  .p-post__header {
    padding: 46px 0 36px;
  }
}

.p-post__metadata {
  color: $color-gray2;
  font-size: $font-size-xs;
  margin-bottom: 10px;
  white-space: nowrap;

  time {
    padding-left: 5px;
  }

  .fa-clock {
    color: $color-teal1;
  }
}

@media screen and (min-width: 768px) {
  .p-post__metadata {
    font-size: $font-size-sm;
    margin-bottom: 20px;
  }
}

.p-post__title {
  font-size: $font-size-xl;
  font-weight: 700;
}

@media screen and (min-width: 768px) {
  .p-post__title {
    font-size: 2.8rem;
  }
}

.p-post__hero {
  margin-bottom: 30px;
}

.p-post__content {
  padding-bottom: 1px;

  p {
    margin: 0 0 1.2em;
    line-height: 1.9;
  }

  h2 {
    background: $color-white2;
    box-shadow: 0 0 3px $color-gray1;
    font-size: $font-size-xl;
    font-weight: 700;
    line-height: 1.5;
    margin: 2.6em 0 1.2em;
    padding: 12px;
    position: relative;
  }

  h2:before {
    background: $color-teal1;
    bottom: 0;
    content: "";
    left: 0;
    min-height: 50px;
    position: absolute;
    top: 0;
    width: 2px;
    z-index: 100;
  }

  h3 {
    font-size: $font-size-lg;
    padding-bottom: 5px;
    border-bottom: 4px solid $color-gray1;
    font-weight: 700;
    line-height: 1.5;
    margin: 1.7em 0 1.2em;
  }

  h4 {
    font-size: $font-size-base;
    font-weight: 700;
    line-height: 1.4;
    margin: 1.7em 0 1.2em;
  }
}

@media screen and (min-width: 768px) {
  .p-post__content {
    p {
      margin: 0 0 1.8em;
    }

    h2 {
      font-size: $font-size-xxxl;
      margin: 2.6em -1em 1.2em;
      padding: 14px 12px 14px 20px;
    }

    h2:before {
      width: 5px;
    }

    h3 {
      font-size: $font-size-xxl;
      margin: 1.8em 0 1.2em;
      padding-bottom: 0.1em;
    }

    h4 {
      font-size: $font-size-lg;
      margin: 1.8em 0 1.2em;
    }
  }
}

.p-post__contents {
  border-radius: 10px;
  background: $color-teal3;
  color: $color-gray3;
  font-weight: 700;
  max-width: 530px;
  margin: 0 auto 30px;
  padding: 10px;
  width: 100%;
}

@media screen and (min-width: 768px) {
  .p-post__contents {
    padding: 20px;
  }
}

.p-post__contents-header {
  font-size: $font-size-lg;
  padding: 8px 0 8px;
  text-align: center;

  .fa-th-list {
    padding-right: 5px;
  }
}

.p-post__contents-list {
  font-size: $font-size-sm;
  list-style: decimal;
  margin: 4px 20px 4px 40px;

  a {
    display: block;
    padding: 8px 0;
  }
}
</style>

<script>
import Breadcrumb from "@/components/partials/blog/Breadcrumb.vue"
import Sidebar from "@/components/partials/blog/Sidebar.vue"

export default {
  layout: "blog",
  components: {
    Breadcrumb,
    Sidebar
  }
}
</script>
