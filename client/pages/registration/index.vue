<template>
  <div class="container">

    <div class="box">
      <div class="box-inner">
        <header class="header">
          <logo />
          <h1 class="header-title">会員情報入力</h1>
        </header>
    
        <main class="register">
          <form @submit.prevent="createUser()" class="register-form">
            <ul v-if="Object.keys(errors).length > 0" class="error-box">
              <li v-for="(value, key) in errors" :key="key" class="error-box-disc">
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
              >
              <div v-if="submitted && !$v.user.username.required" class="error-text">
                ユーザー名は必須です。
              </div>
              <div v-if="submitted && !$v.user.username.minLength" class="error-text">
                ユーザー名は3文字以上で入力してください。
              </div>
              <div v-if="!$v.user.username.maxLength" class="error-text">
                ユーザー名は50文字以下で入力してください。
              </div>
              <div v-if="!$v.user.username.alphaNumName" class="error-text">
                ユーザー名は半角英数字及び_, -で入力してください。
              </div>
            </div>
          
            <div class="register-form-btn">
              <nui-button class="btn-red1" :submit="true">
                登録する
              </nui-button>
            </div>
          </form>
        </main>
      </div>
    </div>
  
    <div class="footer_wrap">
      <Footer />
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
  box-shadow: 0 1.2rem 4rem rgba(0,0,0,.12);
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
  margin-bottom: 2rem;
}

.register-form {
  padding: 0 4rem 9.2rem;
}

@media screen and (min-width: 481px) {
  .register-form {
    padding: 0 4rem 4rem;
  }
}

.form-group {
  margin-bottom: 1rem;

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
  background-color: #fff7f7;
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

.register-form-btn {
  margin-top: 3.2rem;

  .btn {
    width: 100%;
  }
}

.footer_wrap {
  margin-top: auto;
}
</style>

<script>
import NuiButton from "@/components/commons/Button.vue"
import Logo from "@/components/svg/Logo.vue"
import Footer from "@/components/layouts/Footer.vue"
import { required, minLength, maxLength } from "vuelidate/lib/validators"
import auth0Middleware from '~/middleware/auth0'
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
    Logo,
    Footer
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
      this.$v.$touch()
      if (this.$v.$invalid) {
        return
      }

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
        maxLength: maxLength(50),
        alphaNumName
      }
    },
  }
}
</script>