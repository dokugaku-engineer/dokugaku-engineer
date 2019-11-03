<template>
  <div class="container">
    <div class="header">
      <h1>ブログ記事の編集</h1>
    </div>
    <div class="box">
      <div class="box-header">
        <h4>編集</h4>
      </div>
      <div class="box-content">
        <post-form
          :posts="posts"
          :categories="categories"
          :slug="post.slug"
          :title="post.title"
          :content="post.content"
          :parent="post.parent"
          :category-id="post.category_post.category_id"
          :editing="true"
        />
      </div>
    </div>
  </div>
</template>

<script>
import PostForm from "@/components/partials/admin/PostForm.vue"

export default {
  components: {
    PostForm
  },
  async asyncData({ $axios, params }) {
    // OPTIMIZE: 高速化するならpostsのみAPIから取得し、その後postsとpostに分離する。現在は処理の見やすさを重視し、別個にAPIから取得している
    const [posts, post, categories] = await Promise.all([
      $axios.$get(`/posts?except=${params.id}`),
      $axios.$get(`/posts/${params.id}`),
      $axios.$get("/categories")
    ])
    return { posts: posts, post: post, categories: categories }
  }
}
</script>
