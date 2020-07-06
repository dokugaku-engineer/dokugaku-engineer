<template>
  <div>
    <content-header title="ブログ記事ー一覧" />
    <content-box
      title="ブログ記事"
      to="/admin/posts/new"
      button-text="新規作成"
    >
      <template slot="content">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>タイトル</th>
              <th>状態</th>
              <th>編集</th>
              <th>公開・非公開</th>
              <th>削除</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="post in posts" :key="post.id">
              <td>{{ post.id }}</td>
              <td>{{ post.title }}</td>
              <td>{{ post.status }}</td>
              <td>
                <link-button
                  :to="`/admin/posts/${post.id}/edit`"
                  class="btn-xs btn-outline-teal1"
                >
                  編集
                </link-button>
              </td>
              <td>
                <nui-button
                  v-if="post.status === 'private'"
                  class="btn-xs btn-outline-blue"
                  @on-click="publish(post.id)"
                >
                  公開
                </nui-button>
                <nui-button
                  v-if="post.status === 'publish'"
                  class="btn-xs btn-outline-blue"
                  @on-click="unpublish(post.id)"
                >
                  非公開
                </nui-button>
              </td>
              <td>
                <nui-button
                  :disabled="post.deleted_at"
                  class="btn-xs btn-outline-red1"
                  @on-click="destroy(post.id)"
                >
                  削除
                </nui-button>
              </td>
            </tr>
          </tbody>
        </table>
      </template>
    </content-box>
  </div>
</template>

<style lang="scss" scoped>
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
</style>

<script>
import ContentHeader from '@/components/partials/admin/ContentHeader.vue'
import ContentBox from '@/components/partials/admin/ContentBox.vue'
import LinkButton from '@/components/commons/LinkButton.vue'
import NuiButton from '@/components/commons/Button.vue'

export default {
  layout: 'admin',
  components: {
    ContentHeader,
    ContentBox,
    LinkButton,
    NuiButton,
  },
  data() {
    return {
      posts: [],
    }
  },
  async created() {
    const posts = await this.$axios.$get('/posts')
    this.posts = posts
  },
  methods: {
    async publish(postId) {
      const post = await this.$axios.$get(`/posts/${postId}/publish`)
      const foundIndex = this.posts.findIndex((p) => p.id === post.id)
      this.posts.splice(foundIndex, 1, post)
    },
    async unpublish(postId) {
      const post = await this.$axios.$get(`/posts/${postId}/unpublish`)
      const foundIndex = this.posts.findIndex((p) => p.id === post.id)
      this.posts.splice(foundIndex, 1, post)
    },
    async destroy(postId) {
      const post = await this.$axios.$delete(`/posts/${postId}`)
      const foundIndex = this.posts.findIndex((p) => p.id === post.id)
      this.posts.splice(foundIndex, 1)
    },
  },
}
</script>
