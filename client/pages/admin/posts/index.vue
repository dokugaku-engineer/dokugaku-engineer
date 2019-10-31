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
              <td>公開</td>
              <td>非公開</td>
              <td>削除</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  async asyncData({ $axios }) {
    const data = await $axios.$get("/posts")
    return { posts: data }
  }
}
</script>
