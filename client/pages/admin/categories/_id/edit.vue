<template>
  <div class="container">
    <div class="header">
      <h1>カテゴリーの編集</h1>
    </div>
    <div class="box">
      <div class="box-header">
        <h4>編集</h4>
      </div>
      <div class="box-content">
        <category-form
          :categories="categories"
          :slug="category.slug"
          :name="category.name"
          :parent="category.parent"
          :editing="true"
        />
      </div>
    </div>
  </div>
</template>

<script>
import CategoryForm from "@/components/partials/admin/CategoryForm.vue"

export default {
  components: {
    CategoryForm
  },
  async asyncData({ $axios, params }) {
    const [category, categories] = await Promise.all([
      $axios.$get(`/categories/${params.id}`),
      $axios.$get(`/categories?except=${params.id}`)
    ])
    return { category: category, categories: categories }
  }
}
</script>
