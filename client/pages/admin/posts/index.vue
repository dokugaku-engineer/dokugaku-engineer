<template>
  <div class="container">
    <div class="header">
      <h1>ブログ記事ー一覧</h1>
    </div>
    <div class="box">
      <div class="box-header">
        <h4>ブログ記事</h4>
        <n-link to="/admin/posts/new">
          新規作成
        </n-link>
      </div>
      <div class="box-content">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>タイトル</th>
              <th>状態</th>
              <th>編集</th>
              <th>公開</th>
              <th>非公開</th>
              <th>削除</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="post in posts" :key="post.id">
              <td>{{ post.id }}</td>
              <td>{{ post.title }}</td>
              <td>{{ post.status }}</td>
              <td>
                <n-link :to="`/admin/posts/${post.id}/edit`">
                  編集
                </n-link>
              </td>
              <td>
                <button
                  :disabled="post.status === 'publish'"
                  @click="publish(post.id)"
                >
                  公開
                </button>
              </td>
              <td>
                <button
                  :disabled="post.status === 'private'"
                  @click="unpublish(post.id)"
                >
                  非公開
                </button>
              </td>
              <td>
                <button :disabled="post.deleted_at" @click="destroy(post.id)">
                  削除
                </button>
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
  data() {
    return {
      posts: []
    }
  },
  async asyncData({ $axios }) {
    const posts = await $axios.$get("/posts")
    return { posts: posts }
  },
  methods: {
    async publish(postId) {
      const post = await this.$axios.$get(`/posts/${postId}/publish`)
      const foundIndex = this.posts.findIndex(p => p.id === post.id)
      this.posts.splice(foundIndex, 1, post)
    },
    async unpublish(postId) {
      const post = await this.$axios.$get(`/posts/${postId}/unpublish`)
      const foundIndex = this.posts.findIndex(p => p.id === post.id)
      this.posts.splice(foundIndex, 1, post)
    },
    async destroy(postId) {
      const post = await this.$axios.$delete(`/posts/${postId}`)
      const foundIndex = this.posts.findIndex(p => p.id === post.id)
      this.posts.splice(foundIndex, 1)
    }
  }
}
</script>
