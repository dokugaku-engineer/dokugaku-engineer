<template>
  <div>
    <header class="header">
      <h1>カテゴリー一覧</h1>
    </header>
    <main class="box">
      <div class="box-header">
        <h4>カテゴリー</h4>
        <n-link to="/admin/categories/new" class="btn btn-red1">
          新規作成
        </n-link>
      </div>
      <div class="box-content">
        <table class="table">
          <thead>
            <tr>
              <th>カテゴリー</th>
              <th />
            </tr>
          </thead>
          <tbody>
            <tr v-for="category in categories" :key="category.name">
              <td>{{ category.name }}</td>
              <td class="text-right">
                <n-link
                  :to="`/admin/categories/${category.id}/edit`"
                  class="btn btn-xs btn-outline-teal1"
                >
                  編集
                </n-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</template>

<style lang="scss" scoped>
.header {
  font-size: $font-size-xxxl;
  margin-bottom: 40px;
}

.box {
  background-color: $color-white1;
  padding: 20px;
}

.box-header {
  align-items: center;
  border-bottom: solid 1px $color-gray1;
  display: flex;
  padding-bottom: 20px;
  position: relative;

  h4 {
    display: inline-block;
    font-weight: 700;
  }

  a {
    position: absolute;
    right: 10px;
  }
}

.btn {
  border: 1px solid transparent;
  border-radius: 6px;
  box-sizing: border-box;
  display: inline-block;
  line-height: 1.5;
  padding: 0.5rem 2rem;
  text-align: center;
}

.btn-xs {
  font-size: $font-size-xs;
}

.btn-red1 {
  background-color: $color-red1;
  border-color: $color-red1;
  color: $color-white1;
}

.btn-outline-teal1 {
  border-color: $color-teal1;
  color: $color-teal1;
}

.box-content {
  padding: 40px 30px 20px;
}

.table {
  border-collapse: collapse;
  text-align: left;
  width: 100%;

  thead {
    th {
      border-bottom: solid 1px $color-gray1;
      padding-bottom: 10px;
      vertical-align: bottom;
    }
  }

  tbody {
    td {
      border-bottom: solid 1px $color-gray1;
      padding: 10px 0 10px;
    }
  }
}

.text-right {
  text-align: right;
}
</style>

<script>
export default {
  layout: "admin",
  async asyncData({ $axios }) {
    const data = await $axios.$get("/categories")
    return { categories: data }
  }
}
</script>
