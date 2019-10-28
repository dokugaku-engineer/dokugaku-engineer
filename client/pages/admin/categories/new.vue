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
        <form @submit.prevent="createCategory">
          <ul>
            <li v-for="(value, key) in errors" :key="key">
              {{ key }}:&nbsp;{{ value[0] }}
            </li>
          </ul>
          <div>
            <label for="slug">URL名（スラッグ）</label>
            <input v-model="slug" type="text" name="slug" required />
          </div>
          <div>
            <label for="name">カテゴリー名</label>
            <input v-model="name" type="text" name="name" required />
          </div>
          <button type="submit" class="">
            登録する
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      slug: "",
      name: ""
    }
  },
  methods: {
    async createCategory() {
      await this.$axios.$post("/api/categories", {
        slug: this.slug,
        name: this.name
      })
      this.$router.push("/admin/categories/new")
    }
  }
}
</script>
