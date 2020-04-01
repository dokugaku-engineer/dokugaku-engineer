<template>
  <div class="container">
    <div class="heading">
      <h1 class="heading-title">プロフィール</h1>
    </div>
    <main class="main">
      <div v-if="loadingUser" class="loading">
        <i class="fad fa-spinner fa-spin fa-lg"></i>
      </div>
      <div v-if="error" class="profile-form">
        <error-box>
          <p>データ取得時にエラーが発生しました。時間をおいた後、ログインし直してから再度お試しください。</p>
        </error-box>
      </div>
      <div v-if="isAuth0Provider && !auth0User.email_verified" class="profile-form">
        <verification-email-box />
      </div>
      
      <div v-else>
        <div v-if="!loadingUser && !error">
          <form @submit.prevent="updateUser()" class="profile-form">
            <ul v-if="Object.keys(errors).length > 0" class="error-box">
              <li v-for="(value, key) in errors" :key="key" class="error-box-disc">
                {{ value[0] }}
              </li>
            </ul>
    
            <div class="form-group">
              <label for="users[username]">ユーザー名</label>
              <input
                v-model.trim="$v.user.username.$model"
                type="text"
                name="users[username]"
                required
              >
              <div v-if="submitError && !$v.user.username.required" class="error-text">
                ユーザー名は必須です。
              </div>
              <div v-if="submitError && !$v.user.username.minLength" class="error-text">
                ユーザー名は3文字以上で入力してください。
              </div>
              <div v-if="!$v.user.username.maxLength" class="error-text">
                ユーザー名は50文字以下で入力してください。
              </div>
              <div v-if="!$v.user.username.alphaNumName" class="error-text">
                ユーザー名は半角英数字及び_, -で入力してください。
              </div>
            </div>
    
            <div class="form-group">
              <label for="users[email]">メールアドレス</label>
              <input
                v-model.trim="$v.user.email.$model"
                type="text"
                name="users[email]"
                required
              >
              <div v-if="submitError && !$v.user.email.required" class="error-text">
                メールアドレスは必須です。
              </div>
              <div v-if="submitError && !$v.user.email.email" class="error-text">
                メールアドレスのフォーマットが不適切です。
              </div>
            </div>
          
            <div class="profile-form-btn">
              <nui-button v-if="submitPending" class="btn-red1">
                <i class="fad fa-spinner fa-spin fa-lg"></i>
              </nui-button>
              <nui-button v-else class="btn-red1" :submit="true">
                変更する
              </nui-button>
            </div>
          </form>
          <nuxt-link to="/settings/quit" class="quit-link">アカウントを削除される場合はこちら</nuxt-link>
        </div>
      </div>
    </main>
  </div>
</template>

<style lang="scss" scoped>
.heading {
  padding: 4rem 2.4rem;
}

@media screen and (min-width: 769px) {
  .heading {
    padding: 4rem;
  }
}

.heading-title {
  font-size: $font-size-xxxl;
  font-weight: 700;
}

.main {
  position: relative;
}

.profile-form {
  padding: 0 2.4rem 2.4rem;
}

.profile-form-btn {
  margin-top: 3.2rem;

  .btn {
    width: 100%;
  }
}

@media screen and (min-width: 769px) {
  .profile-form {
    padding: 0 4rem 4rem;
  }
}

.form-group {
  margin-bottom: 2.4rem;

  label {
    font-size: $font-size-sm;
    font-weight: 600;
  }

  input {
    border: 1px solid $color-gray1;
    border-radius: 0.4rem;
    color: $color-black;
    margin-top: .8rem;
    max-height: 3.2rem;
    padding: 2rem .8rem 2rem;
    width: 100%;
  }
}

.form-require {
  background: $color-red1;
  margin: 0 0 0 .8rem;
  padding: .2rem .4rem;
  border-radius: .2rem;
  color: #fff;
  font-size: $font-size-xs;
  vertical-align: top;
}

.error-box {
  background-color: $color-red3;
  border-radius: .4rem;
  color: $color-red1;
  font-size: $font-size-sm;
  font-weight: 700;
  margin-bottom: 3.5rem;
  padding: 1.5rem 3rem;
}

.error-box-disc {
  list-style-type: disc;
}

.error-text {
  color: $color-red1;
  font-size: $font-size-sm;
  margin-top: .8rem;
}

.loading {
  color: $color-teal1;
  left: 47%;
  position: absolute;
}

.quit-link {
  float: right;
  font-size: $font-size-xs;
  margin: 5rem 0 4rem;
  padding-right: 1.5rem;
}
</style>

<style lang="scss">
.toast-success {
  background-color: $color-teal1 !important;
}
</style>

<script>
import NuiButton from "@/components/commons/Button.vue"
import ErrorBox from "@/components/commons/ErrorBox.vue"
import VerificationEmailBox from "@/components/partials/course/VerificationEmailBox.vue"
import { required, minLength, maxLength, email } from "vuelidate/lib/validators"
import { mapState, mapGetters } from 'vuex'

const alphaNumName = (name) => {
  if (typeof name === 'undefined' || name === null || name === '') {
    return true
  }
  return /^[a-z0-9\-_]+$/.test(name)
}

export default {
  layout: "logined",
  components: {
    NuiButton,
    ErrorBox,
    VerificationEmailBox
  },
  data() {
    return {
      user: {
        username: '',
        email: '',
      },
      submitStatus: 'OK',
      loadingUser: false,
      error: null
    }
  },
  computed: {
    ...mapState('auth0', ['auth0User']),
    ...mapGetters('auth0', ['userId', 'isAuth0Provider']),
    submitError() {
      return this.submitStatus === 'ERROR'
    },
    submitPending() {
      return this.submitStatus === 'PENDING'
    }
  },
  beforeCreate() {
    this.$store.dispatch('setting/setTitle', { title: 'プロフィール' })
  },
  async created() {
    this.loadingUser = true
    const options = await this.getOptions()
    await this.$axios.$get(`/users/${this.userId}`, options)
      .then(res => {
        this.user.username = res.username
        this.user.email = res.email
      })
      .catch(err => {
        this.error = err.response
      })
    
    this.loadingUser = false
  },
  methods: {
    async updateUser() {
      this.submitStatus = 'PENDING'
      this.$v.$touch()
      if (this.$v.$invalid) {
        this.submitStatus = 'ERROR'
        return
      }

      const options = await this.getOptions()
      await this.$axios
        .$patch(`/users/${this.userId}`, this.user, options)
        .then(res => {
          this.submitStatus = 'OK'
          this.$toast.global.instant_success()
        })
        .catch(err => {
          this.submitStatus = 'ERROR'
        })
    },
    async getOptions() {
      const token = await this.$auth0.getTokenSilently()
      return {
        headers: {
          Authorization: `Bearer ${token}`
        }
      }
    }
  },
  validations: {
    user: {
      username: {
        required,
        minLength: minLength(3),
        maxLength: maxLength(50),
        alphaNumName
      },
      email: {
        required,
        email
      }
    },
  }
}
</script>