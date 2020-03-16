<template>
  <div>
    <div class="message">
      <h1>独学エンジニアへようこそ！</h1>
      <p>新規登録して講座を受講しましょう。</p>
    </div>

    <form @submit.prevent="createUser()">
      <ul>
        <li v-for="(value, key) in errors" :key="key">
          {{ key }}:&nbsp;{{ value[0] }}
        </li>
      </ul>

      <div class="form">
        <div class="form-input">
          <label for="users[username]">ユーザー名</label>
          <input v-model.trim="$v.user.username.$model" type="text" name="users[username]" required>
        </div>
        <div v-if="submitted && !$v.user.username.required" class="error error-text">
          ユーザー名は必須です。
        </div>
        <div v-if="submitted && !$v.user.username.minLength" class="error error-text">
          ユーザー名は3文字以上で入力してください。
        </div>
        <div v-if="submitted && !$v.user.username.maxLength" class="error error-text">
          ユーザー名は50文字以下で入力してください。
        </div>
      </div>
  
      <div class="form-btn">
        <nui-button class="btn-red1" :submit="true">
          登録する
        </nui-button>
      </div>
    </form>
  </div>
</template>

<style lang="scss">

</style>

<script>
import NuiButton from "@/components/commons/Button.vue"
import { required, minLength, maxLength } from "vuelidate/lib/validators"
import auth0Middleware from '~/middleware/auth0'
import { mapState } from 'vuex'

export default {
  layout: 'none',
  components: {
    NuiButton
  },
  data() {
    return {
      user: {
        username: '',
        email: '',
        auth0Userid: ''
      },
      submitted: false,
      state: this.$route.query.state,
    }
  },
  computed: {
    ...mapState('auth0', {
      auth0User: 'user',
      isAuthenticated: 'isAuthenticated'
    })
  },
  middleware: auth0Middleware.protectRegistration(),
  methods: {
    async createUser() {
      this.submitted = true
      this.user.email = this.auth0User.email
      this.user.auth0Userid = this.auth0User.sub
      await this.$axios
        .$post("/users", this.user)
        .then(response => {
          this.submitted = false
        })  
        .catch((e) => {
          this.submitted = true
        })
      
      if (this.submitted) { return }
      
      this.$store.commit('auth0/SET_USER', await this.$auth0.getUser())
      window.location.assign('/course/serverside')
    },
  },
  validations: {
    user: {
      username: {
        required,
        minLength: minLength(3),
        maxLength: maxLength(50)
      }
    },
  }
}
</script>