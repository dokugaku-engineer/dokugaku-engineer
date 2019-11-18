<template>
  <div>
    <content-header title="カテゴリー一覧" />
    <content-box>
      <template slot="header">
        <div class="header">
          <h4>カテゴリー</h4>
          <link-button to="/admin/categories/new" class="btn-red1">
            新規作成
          </link-button>
        </div>
      </template>
      <template slot="content">
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
                <link-button
                  :to="`/admin/categories/${category.id}/edit`"
                  class="btn-xs btn-outline-teal1"
                >
                  編集
                </link-button>
              </td>
            </tr>
          </tbody>
        </table>
      </template>
    </content-box>
  </div>
</template>

<style lang="scss" scoped>
.header {
  align-items: center;
  display: flex;
  position: relative;

  a {
    position: absolute;
    right: 10px;
  }
}

.table {
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
import ContentHeader from "@/components/partials/admin/ContentHeader.vue"
import ContentBox from "@/components/partials/admin/ContentBox.vue"
import LinkButton from "@/components/commons/LinkButton.vue"

export default {
  layout: "admin",
  components: {
    ContentHeader,
    ContentBox,
    LinkButton
  },
  async asyncData({ $axios }) {
    const data = await $axios.$get("/categories")
    return { categories: data }
  }
}
</script>
