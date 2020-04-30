<template>
  <div>
    <content-header title="ブログ記事の新規作成" />
    <content-box title="新規作成">
      <template slot="content">
        <post-form :posts="posts" :categories="categories" />
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
    PostForm,
  },
  data() {
    return {
      categories: [],
      posts: [],
    }
  },
  async created() {
    const [posts, categories] = await Promise.all([
      this.$axios.$get("/posts"),
      this.$axios.$get("/categories"),
    ])
    this.posts = posts
    this.categories = categories
  },
}
</script>
