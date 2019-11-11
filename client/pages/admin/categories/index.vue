<template>
  <div class="container">
    <div class="header">
      <h1>カテゴリー一覧</h1>
    </div>
    <div class="box">
      <div class="box-header">
        <h4>カテゴリー</h4>
        <n-link to="/admin/categories/new">
          新規作成
        </n-link>
      </div>
      <div class="box-content">
        <table>
          <thead>
            <tr>
              <th>カテゴリー</th>
              <th>編集</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="category in categories" :key="category.name">
              <td>{{ category.name }}</td>
              <td>
                <n-link :to="`/admin/categories/${category.id}/edit`">
                  編集
                </n-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  layout: "admin",
  async asyncData({ $axios }) {
    const data = await $axios.$get("/categories")
    return { categories: data }
  }
}
</script>
