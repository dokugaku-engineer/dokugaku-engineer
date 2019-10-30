<template>
  <div class="container">
    <div class="header">
      <h1>ブログの新規作成</h1>
    </div>
    <div class="box">
      <div class="box-header">
        <h4>新規作成</h4>
      </div>
      <div class="box-content">
        <post-form :categories="categories" />
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
    const data = await $axios.$get("/categories")
    return { categories: data }
  }
}
</script>
