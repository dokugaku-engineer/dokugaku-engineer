<template>
  <div class="p-blog__content clearfix">
    <breadcrumb />
    <main class="p-blog__main">
      <section class="p-blog-category">
        <h1 class="p-blog-category__title">
          web
        </h1>
      </section>
      <Article />
    </main>
    <sidebar />
  </div>
</template>

<style lang="scss" scoped>
.p-blog__content {
  background-color: $color-white2;
}

@media screen and (min-width: 769px) {
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

@media screen and (min-width: 769px) {
  .p-blog__main {
    float: left;
    width: 67%;
  }
}

.p-blog-category {
  border-bottom: solid 2px $color-black;
  text-align: center;
  width: 100%;
}

@media screen and (min-width: 769px) {
  .p-blog-category {
    margin-bottom: 25px;
  }
}

.p-blog-category__title {
  font-size: $font-size-xxl;
  font-weight: 700;
  margin-bottom: 4px;
}
</style>

<script>
import Breadcrumb from "@/components/partials/blog/Breadcrumb.vue"
import Article from "@/components/partials/blog/Article.vue"
import Sidebar from "@/components/partials/blog/Sidebar.vue"

export default {
  layout: "blog",
  components: {
    Breadcrumb,
    Article,
    Sidebar,
  },
}
</script>
