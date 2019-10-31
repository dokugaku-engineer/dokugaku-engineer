<template>
  <div class="container">
    <div class="header">
      <h1>ブログ記事の新規作成</h1>
    </div>
    <div class="box">
      <div class="box-header">
        <h4>新規作成</h4>
      </div>
      <div class="box-content">
        <post-form :posts="posts" :categories="categories" />
      </div>
    </div>
  </div>
</template>

<script>
import PostForm from "@/components/admin/partials/PostForm.vue"

export default {
  components: {
    PostForm
  },
  async asyncData({ $axios }) {
    const [posts, categories] = await Promise.all([
      $axios.$get("/posts"),
      $axios.$get("/categories")
    ])
    return { posts: posts, categories: categories }
  }
}
</script>
