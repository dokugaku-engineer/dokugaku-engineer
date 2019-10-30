<template>
  <div class="container">
    <div class="header">
      <h1>カテゴリーの新規作成</h1>
    </div>
    <div class="box">
      <div class="box-header">
        <h4>新規作成</h4>
      </div>
      <div class="box-content">
        <category-form :categories="categories" />
      </div>
    </div>
  </div>
</template>

<script>
import CategoryForm from "@/components/admin/partials/CategoryForm.vue"

export default {
  components: {
    CategoryForm
  },
  async asyncData({ $axios }) {
    const data = await $axios.$get("/categories")
    return { categories: data }
  }
}
</script>
