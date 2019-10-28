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
        <form @submit.prevent="handleSubmit">
          <ul>
            <li v-for="(value, key) in errors" :key="key">
              {{ key }}:&nbsp;{{ value[0] }}
            </li>
          </ul>
          <div :class="{ error: $v.category.slug.$error }">
            <label for="slug">URL名（スラッグ）</label>
            <input
              v-model.trim="$v.category.slug.$model"
              type="text"
              name="slug"
              required
            />
          </div>
          <div v-if="submitted && !$v.category.slug.required" class="error">
            URL名（スラッグ）は必須です。
          </div>
          <div v-if="!$v.category.slug.maxLength" class="error">
            URL名（スラッグ）は最大で
            {{ $v.category.slug.$params.maxLength.max }}
            文字です。
          </div>
          <div :class="{ error: $v.category.name.$error }">
            <label for="name">カテゴリー名</label>
            <input
              v-model="$v.category.name.$model"
              type="text"
              name="name"
              required
            />
          </div>
          <div v-if="submitted && !$v.category.name.required" class="error">
            カテゴリー名は必須です。
          </div>
          <div v-if="!$v.category.name.maxLength" class="error">
            カテゴリー名は最大で
            {{ $v.category.name.$params.maxLength.max }}
            文字です。
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
import { required, maxLength } from "vuelidate/lib/validators"

export default {
  data() {
    return {
      category: {
        slug: "",
        name: ""
      },
      submitted: false
    }
  },
  methods: {
    async handleSubmit() {
      this.submitted = true
      await this.$axios.$post("/api/categories", {
        slug: this.category.slug,
        name: this.category.name
      })
      this.$router.push("/admin/categories/new")
    }
  },
  validations: {
    category: {
      slug: {
        required,
        maxLength: maxLength(255)
      },
      name: {
        required,
        maxLength: maxLength(255)
      }
    }
  }
}
</script>
