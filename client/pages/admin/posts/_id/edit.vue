<template>
  <div>
    <content-header title="ブログ記事の編集" />
    <content-box title="編集">
      <template slot="content">
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
      </template>
    </content-box>
  </div>
</template>

<script>
import ContentHeader from "@/components/partials/admin/ContentHeader.vue"
import ContentBox from "@/components/partials/admin/ContentBox.vue"
import PostForm from "@/components/partials/admin/PostForm.vue"

export default {
  layout: "admin",
  components: {
    ContentHeader,
    ContentBox,
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
