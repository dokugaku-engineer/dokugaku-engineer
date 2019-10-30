<template>
  <form @submit.prevent="isEditing ? updateCategory() : createCategory()">
    <ul>
      <li v-for="(value, key) in errors" :key="key">
        {{ key }}:&nbsp;{{ value[0] }}
      </li>
    </ul>
    <div :class="{ error: $v.category.slug.$error }">
      <label for="slug">URL（スラッグ）</label>
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
    <div v-if="!$v.category.slug.alphaNum" class="error">
      URL名（スラッグ）は英数字のみ入力可能です。
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
    <div :class="{ error: $v.category.parent.$error }">
      <label for="parent">親カテゴリー</label>
      <select v-model="$v.category.parent.$model" name="parent">
        <option :value="0">
          親なし
        </option>
        <option v-for="c in categories" :key="c.id" :value="c.id">
          {{ c.name }}
        </option>
      </select>
    </div>
    <div v-if="!$v.category.parent.numeric" class="error">
      親カテゴリーは数値のみ入力可能です。
    </div>
    <button type="submit">
      登録する
    </button>
  </form>
</template>

<script>
import { required, maxLength, numeric, helpers } from "vuelidate/lib/validators"

export default {
  props: {
    categories: {
      type: Array,
      default() {
        return []
      }
    },
    slug: {
      type: String,
      default: ""
    },
    name: {
      type: String,
      default: ""
    },
    parent: {
      type: Number,
      default: 0
    },
    editing: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      category: {
        slug: this.slug,
        name: this.name,
        parent: this.parent
      },
      submitted: false,
      isEditing: this.editing
    }
  },
  methods: {
    async createCategory() {
      this.submitted = true
      await this.$axios
        .$post("/categories", this.category)
        .then(() => {
          this.submitted = false
          this.$router.push("/admin/categories/")
        })
        .catch(() => {
          this.submitted = true
        })
    },
    async updateCategory() {
      this.submitted = true
      await this.$axios
        .$put(`/categories/${this.$route.params.id}`, this.category)
        .then(() => {
          this.submitted = false
          this.$router.push("/admin/categories/")
        })
        .catch(() => {
          this.submitted = true
        })
    }
  },
  validations: {
    category: {
      slug: {
        required,
        alphaNum: helpers.regex("", /^[a-zA-Z0-9\-_]+$/),
        maxLength: maxLength(255)
      },
      name: {
        required,
        maxLength: maxLength(255)
      },
      parent: {
        numeric
      }
    }
  }
}
</script>
