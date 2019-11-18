<template>
  <div>
    <content-header title="カテゴリーの新規作成" />
    <content-box>
      <template slot="header">
        <div class="header">
          <h4>新規作成</h4>
        </div>
      </template>
      <template slot="content">
        <category-form :categories="categories" />
      </template>
    </content-box>
  </div>
</template>

<style lang="scss" scoped></style>

<script>
import ContentHeader from "@/components/partials/admin/ContentHeader.vue"
import ContentBox from "@/components/partials/admin/ContentBox.vue"
import CategoryForm from "@/components/partials/admin/CategoryForm.vue"

export default {
  layout: "admin",
  components: {
    ContentHeader,
    ContentBox,
    CategoryForm
  },
  async asyncData({ $axios }) {
    const data = await $axios.$get("/categories")
    return { categories: data }
  }
}
</script>
