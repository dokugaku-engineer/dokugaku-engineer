<template>
  <div class="container">
    <div class="box">
      <div class="box-inner">
        <header class="header">
          <logo />
          <h1 class="header-title">会員情報入力</h1>
        </header>

        <main class="register">
          <nui-form>
            <form class="register-form" @submit.prevent="createUser()">
              <ul v-if="Object.keys(errors).length > 0" class="error-box">
                <li
                  v-for="(value, key) in errors"
                  :key="key"
                  class="error-box-disc"
                >
                  {{ value[0] }}
                </li>
              </ul>

              <div class="form-group">
                <label for="users[username]">ユーザー名</label>
                <span class="form-require">必須</span>
                <input
                  v-model.trim="$v.user.username.$model"
                  type="text"
                  name="users[username]"
                  placeholder="例）dokugaku"
                  required
                />
                <div
                  v-if="submitError && !$v.user.username.required"
                  class="error-text"
                >
                  ユーザー名は必須です。
                </div>
                <div
                  v-if="submitError && !$v.user.username.minLength"
                  class="error-text"
                >
                  ユーザー名は3文字以上で入力してください。
                </div>
                <div v-if="!$v.user.username.maxLength" class="error-text">
                  ユーザー名は50文字以下で入力してください。
                </div>
              </div>
              <div v-if="!$v.user.username.alphaNumName" class="error-text">
                ユーザー名は半角英数字及び_, -で入力してください。
              </div>

              <div v-if="!auth0User.email" class="form-group">
                <label for="users[email]">メールアドレス</label>
                <span class="form-require">必須</span>
                <input
                  v-model.trim="$v.user.email.$model"
                  type="text"
                  name="users[email]"
                  placeholder="PC・携帯どちらでも可"
                  required
                />
                <div
                  v-if="submitError && !$v.user.email.required"
                  class="error-text"
                >
                  メールアドレスは必須です。
                </div>
                <div
                  v-if="submitError && !$v.user.email.email"
                  class="error-text"
                >
                  メールアドレスのフォーマットが不適切です。
                </div>
              </div>

              <div class="form-group">
                <p class="single-text">
                  「登録する」のボタンを押すことにより、
                  <nuxt-link to="/term" target="_blank"> 利用規約 </nuxt-link>
                  に同意したものとみなします。
                </p>
              </div>

              <div class="register-form-btn">
                <nui-button class="btn-red1" :submit="true">
                  登録する
                </nui-button>
              </div>
            </form>
          </nui-form>
          <div class="register-note-wrap">
            <button class="register-note" @click="logout">
              ログインし直したい方はこちら
            </button>
          </div>
        </main>
      </div>
    </div>

    <LoadingModal :show-modal="submitPending" />

    <div class="footer_wrap">
      <simple-footer />
    </div>
  </div>
</template>

<style lang="scss">
.container {
  background-color: $color-white2;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

@media screen and (min-width: 481px) {
  .box {
    height: auto;
    margin: auto;
    position: relative;
    width: 40rem;
  }
}

.box-inner {
  box-shadow: 0 1.2rem 4rem rgba(0, 0, 0, 0.12);
}

.header {
  background-color: $color-white1;
  padding: 4rem 4rem 2.4rem;
  text-align: center;
}

.header-title {
  font-size: $font-size-xxxl;
  font-weight: 400;
  margin: 2.4rem 0 1.6rem;
  text-align: center;
}

.register {
  background-color: $color-white1;
}

.register-form {
  padding: 0 4rem 4rem;
}

@media screen and (min-width: 481px) {
  .register-form {
    padding: 0 4rem 4rem;
  }
}

.single-text {
  font-size: $font-size-sm;
  text-align: center;

  a {
    color: $color-blue;
  }
}

.register-form-btn {
  margin-top: 3.2rem;

  .btn {
    width: 100%;
  }
}

.register-note-wrap {
  text-align: center;
  padding-bottom: 4rem;
}

.register-note {
  font-size: $font-size-xs;
}

.footer_wrap {
  margin-top: auto;
}
</style>

<script>
import Meta from '@/assets/mixins/meta'
import NuiButton from '@/components/commons/Button.vue'
import NuiForm from '@/components/commons/Form.vue'
import LoadingModal from '@/components/commons/LoadingModal.vue'
import Logo from '@/components/svg/Logo.vue'
import SimpleFooter from '@/components/layouts/SimpleFooter.vue'
import { required, minLength, maxLength, email } from 'vuelidate/lib/validators'
import auth0Middleware from '@/middleware/auth0'
import { mapState } from 'vuex'

const alphaNumName = (name) => {
  if (typeof name === 'undefined' || name === null || name === '') {
    return true
  }
  return /^[a-z0-9\-_]+$/.test(name)
}

export default {
  layout: 'none',
  components: {
    NuiButton,
    NuiForm,
    LoadingModal,
    Logo,
    SimpleFooter,
  },
  mixins: [Meta],
  data() {
    return {
      user: {
        username: '',
        email: '',
        auth0Userid: '',
      },
      submitStatus: 'OK',
      state: this.$route.query.state,
      meta: {
        title: '会員情報入力',
      },
    }
  },
  computed: {
    ...mapState('auth0', ['auth0User', 'isAuthenticated']),
    submitError() {
      return this.submitStatus === 'ERROR'
    },
    submitPending() {
      return this.submitStatus === 'PENDING'
    },
  },
  methods: {
    async createUser() {
      if (this.auth0User.email) {
        this.user.email = this.auth0User.email
      }
      this.user.auth0Userid = this.auth0User.sub
      this.$v.$touch()
      if (this.$v.$invalid) {
        this.submitStatus = 'ERROR'
        return
      }

      // ユーザーを登録する
      this.submitStatus = 'PENDING'
      await this.$axios
        .$post('/users', this.user)
        .then((res) => {
          this.user.id = res.id
          this.submitStatus = 'PENDING'
        })
        .catch((err) => {
          this.submitStatus = 'ERROR'
          this.$sentry.captureException(err)
        })

      if (this.submitStatus === 'ERROR') {
        return
      }

      // 受講情報を登録する
      const SEVERSIDE_COURSE_ID = 1
      await this.$axios
        .$post('/taking_courses', {
          user_id: this.user.id,
          course_id: SEVERSIDE_COURSE_ID,
        })
        .catch((err) => {
          this.submitStatus = 'ERROR'
          this.$sentry.captureException(err)
        })

      if (this.submitStatus === 'ERROR') {
        return
      }

      this.$store.commit('auth0/SET_AUTH0_USER', await this.$auth0.getUser())
      this.submitStatus = 'OK'
      window.location.assign('/course/serverside')
    },
    async logout() {
      await this.$auth0.logout({ returnTo: window.location.origin })
    },
  },
  middleware: auth0Middleware.protectRegistration(),
  validations: {
    user: {
      username: {
        required,
        minLength: minLength(3),
        maxLength: maxLength(50),
        alphaNumName,
      },
      email: {
        required,
        email,
      },
    },
  },
}
</script>
