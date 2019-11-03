<template>
  <form @submit.prevent="isEditing ? updatePost() : createPost()">
    <ul>
      <li v-for="(value, key) in errors" :key="key">
        {{ key }}:&nbsp;{{ value[0] }}
      </li>
    </ul>

    <div :class="{ error: $v.post.slug.$error }">
      <label for="posts[slug]">URL（スラッグ）</label>
      <input
        v-model.trim="$v.post.slug.$model"
        type="text"
        name="posts[slug]"
        required
      />
    </div>
    <div v-if="submitted && !$v.post.slug.required" class="error">
      URL名（スラッグ）は必須です。
    </div>
    <div v-if="!$v.post.slug.alphaNum" class="error">
      URL名（スラッグ）は英数字のみ入力可能です。
    </div>
    <div v-if="!$v.post.slug.maxLength" class="error">
      URL名（スラッグ）は最大で
      {{ $v.post.slug.$params.maxLength.max }}
      文字です。
    </div>

    <div :class="{ error: $v.post.title.$error }">
      <label for="posts[title]">タイトル</label>
      <input
        v-model="$v.post.title.$model"
        type="text"
        name="posts[title]"
        required
      />
    </div>
    <div v-if="submitted && !$v.post.title.required" class="error">
      タイトルは必須です。
    </div>
    <div v-if="!$v.post.title.maxLength" class="error">
      タイトルは最大で
      {{ $v.post.title.$params.maxLength.max }}
      文字です。
    </div>

    <div :class="{ error: $v.post.content.$error }">
      <label for="posts[content]">本文</label>
      <input
        v-model="$v.post.content.$model"
        type="text"
        name="posts[content]"
        required
      />
    </div>
    <div v-if="submitted && !$v.post.content.required" class="error">
      本文は必須です。
    </div>

    <div :class="{ error: $v.post.parent.$error }">
      <label for="posts[parent]">親記事</label>
      <select v-model="$v.post.parent.$model" name="posts[parent]">
        <option :value="0">
          親なし
        </option>
        <option v-for="p in posts" :key="p.id" :value="p.id">
          {{ p.id }}
        </option>
      </select>
    </div>
    <div v-if="!$v.post.parent.numeric" class="error">
      親記事は数値のみ入力可能です。
    </div>

    <div :class="{ error: $v.categoryPost.category_id.$error }">
      <label for="category_posts[category_id]">カテゴリー</label>
      <select
        v-model="$v.categoryPost.category_id.$model"
        name="category_posts[category_id]"
      >
        <option v-for="c in categories" :key="c.id" :value="c.id">
          {{ c.name }}
        </option>
      </select>
    </div>
    <div v-if="!$v.categoryPost.category_id.numeric" class="error">
      カテゴリーは数値のみ入力可能です。
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
    posts: {
      type: Array,
      default() {
        return []
      }
    },
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
    title: {
      type: String,
      default: ""
    },
    content: {
      type: String,
      default: ""
    },
    parent: {
      type: Number,
      default: 0
    },
    categoryId: {
      type: Number,
      default: 1
    },
    editing: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      post: {
        slug: this.slug,
        title: this.title,
        content: this.content,
        parent: this.parent
      },
      categoryPost: {
        category_id: this.categoryId // APIの形式に合わせてスネークケースにする
      },
      submitted: false,
      isEditing: this.editing
    }
  },
  methods: {
    async createPost() {
      this.submitted = true
      await this.$axios
        .$post("/posts", {
          posts: this.post,
          category_posts: this.categoryPost
        })
        .then(() => {
          this.submitted = false
          this.$router.push("/admin/posts/")
        })
        .catch(() => {
          this.submitted = true
        })
    },
    async updatePost() {
      this.submitted = true
      await this.$axios
        .$put(`/posts/${this.$route.params.id}`, {
          posts: this.post,
          category_posts: this.categoryPost
        })
        .then(() => {
          this.submitted = false
          this.$router.push("/admin/posts/")
        })
        .catch(() => {
          this.submitted = true
        })
    }
  },
  validations: {
    post: {
      slug: {
        required,
        alphaNum: helpers.regex("", /^[a-zA-Z0-9\-_]+$/),
        maxLength: maxLength(255)
      },
      title: {
        required,
        maxLength: maxLength(255)
      },
      content: {
        required
      },
      parent: {
        numeric
      }
    },
    categoryPost: {
      category_id: {
        required,
        numeric
      }
    }
  }
}
</script>
