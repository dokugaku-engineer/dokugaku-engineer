<template>
  <div>
    <content-header title="カテゴリーの編集" />
    <content-box title="編集">
      <template slot="content">
        <category-form
          :categories="categories"
          :slug="category.slug"
          :name="category.name"
          :parent="category.parent"
          :editing="true"
        />
      </template>
    </content-box>
  </div>
</template>

<script>
import ContentHeader from '@/components/partials/admin/ContentHeader.vue'
import ContentBox from '@/components/partials/admin/ContentBox.vue'
import CategoryForm from '@/components/partials/admin/CategoryForm.vue'

export default {
  layout: 'admin',
  components: {
    ContentHeader,
    ContentBox,
    CategoryForm,
  },
  data() {
    return {
      category: {},
      categories: [],
    }
  },
  async created() {
    // TODO: データを取得できてない
    const [category, categories] = await Promise.all([
      this.$axios.$get(`/categories/${this.$route.params.id}`),
      this.$axios.$get(`/categories?except=${this.$route.params.id}`),
    ])
    this.category = category
    this.categories = categories
  },
}
</script>
