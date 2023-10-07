<template>
  <form @submit.prevent="isEditing ? updateCategory() : createCategory()">
    <ul>
      <li v-for="(value, key) in errors" :key="key">
        {{ key }}:&nbsp;{{ value[0] }}
      </li>
    </ul>

    <div class="form">
      <div class="form-input" :class="{ error: $v.category.slug.$error }">
        <label for="slug">URL（スラッグ）</label>
        <input
          v-model.trim="$v.category.slug.$model"
          type="text"
          name="slug"
          required
        />
      </div>
      <div
        v-if="submitted && !$v.category.slug.required"
        class="error error-text"
      >
        URL名（スラッグ）は必須です。
      </div>
      <div v-if="!$v.category.slug.alphaNum" class="error error-text">
        URL名（スラッグ）は英数字のみ入力可能です。
      </div>
      <div v-if="!$v.category.slug.maxLength" class="error error-text">
        URL名（スラッグ）は最大で
        {{ $v.category.slug.$params.maxLength.max }}
        文字です。
      </div>
    </div>

    <div class="form">
      <div class="form-input" :class="{ error: $v.category.name.$error }">
        <label for="name">カテゴリー名</label>
        <input
          v-model="$v.category.name.$model"
          type="text"
          name="name"
          required
        />
      </div>
      <div
        v-if="submitted && !$v.category.name.required"
        class="error error-text"
      >
        カテゴリー名は必須です。
      </div>
      <div v-if="!$v.category.name.maxLength" class="error error-text">
        カテゴリー名は最大で
        {{ $v.category.name.$params.maxLength.max }}
        文字です。
      </div>
    </div>

    <div class="form" :class="{ error: $v.category.parent.$error }">
      <label for="parent">親カテゴリー</label>
      <div class="form-select">
        <select v-model="$v.category.parent.$model" name="parent">
          <option :value="0">親なし</option>
          <option v-for="c in categories" :key="c.id" :value="c.id">
            {{ c.name }}
          </option>
        </select>
      </div>
      <div v-if="!$v.category.parent.numeric" class="error error-text">
        親カテゴリーは数値のみ入力可能です。
      </div>
    </div>

    <div class="form-btn">
      <nui-button class="btn-red1" submit="true"> 登録する </nui-button>
    </div>
  </form>
</template>

<style lang="scss" scoped>
.form {
  margin-bottom: 10px;

  label {
    display: block;
    margin-bottom: 5px;
  }
}

.form-input {
  input {
    border: 1px solid $color-gray1;
    border-radius: 0.25rem;
    color: $color-black;
    max-height: 32px;
    padding: 20px 8px 20px;
    width: 100%;
  }
}

.form-select {
  border: 1px solid $color-gray1;
  border-radius: 0.25rem;
  position: relative;
  color: $color-black;

  select {
    color: $color-black;
    padding: 10px 8px 10px;
    width: 100%;
  }

  &::after {
    bottom: 0;
    color: $color-gray2;
    content: '\f0d7';
    display: block;
    font-family: 'Font Awesome 5 Pro';
    font-size: 0.8em;
    font-weight: 900;
    height: 1em;
    margin: auto;
    pointer-events: none;
    position: absolute;
    right: 0.5em;
    top: 0;
    width: 1em;
  }
}

.form-btn {
  margin-top: 50px;
  text-align: center;
}

.error {
  color: $color-red1;
}

.error-text {
  font-size: $font-size-sm;
}
</style>

<script>
import NuiButton from '@/components/commons/Button.vue'
import { required, maxLength, numeric, helpers } from 'vuelidate/lib/validators'

export default {
  components: {
    NuiButton,
  },
  props: {
    categories: {
      type: Array,
      default() {
        return []
      },
    },
    slug: {
      type: String,
      default: '',
    },
    name: {
      type: String,
      default: '',
    },
    parent: {
      type: Number,
      default: 0,
    },
    editing: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      category: {
        slug: this.slug,
        name: this.name,
        parent: this.parent,
      },
      submitted: false,
      isEditing: this.editing,
    }
  },
  methods: {
    async createCategory() {
      this.submitted = true
      await this.$axios
        .$post('/categories', this.category)
        .then(() => {
          this.submitted = false
          this.$router.push('/admin/categories/')
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
          this.$router.push('/admin/categories/')
        })
        .catch(() => {
          this.submitted = true
        })
    },
  },
  validations: {
    category: {
      slug: {
        required,
        alphaNum: helpers.regex('', /^[a-zA-Z0-9\-_]+$/),
        maxLength: maxLength(255),
      },
      name: {
        required,
        maxLength: maxLength(255),
      },
      parent: {
        numeric,
      },
    },
  },
}
</script>
