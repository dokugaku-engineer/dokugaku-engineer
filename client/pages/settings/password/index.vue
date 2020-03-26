<template>
<div class="container">
  <div class="heading">
    <h1 class="heading-title">パスワードの設定</h1>
  </div>
  <main>
    <div v-if="isAuth0Provider" class="profile">
      <div v-if="error">
        <error-box>
          <p>メール送信にエラーが発生しました。時間をおいた後、ログインし直してから再度お試しください。</p>
        </error-box>
      </div>

      <p>ご登録されたメールアドレスにパスワード再設定のご案内が送信されます。</p>
      <div class="profile-btn">
        <nui-button class="btn-red1" @click.native="sendChangePasswordEmail">
          送信する
        </nui-button>
      </div>
    </div>

    <div v-else class="profile">
      <div class="profile-notice">
        <h3 class="profile-message">このアカウントは{{ providers.join('、') }}と連携しています</h3>
        <p>メールアドレスでログインする場合、パスワードを設定できます。</p>
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

.profile {
  padding: 0 2.4rem 2.4rem;
}

@media screen and (min-width: 769px) {
  .profile {
    padding: 0 4rem 4rem;
  }
}

.profile-notice {
  background-color: $color-red3;
  text-align: center;
  padding: 2rem;
}

@media screen and (min-width: 769px) {
  .profile-notice {
    padding: 3rem;
  }
}

.profile-message {
  font-size: $font-size-lg;
  font-weight: 700;
  margin-bottom: 3rem;
}

.profile-btn {
  margin-top: 3.2rem;

  .btn {
    width: 100%;
  }
}
</style>

<script>
import ErrorBox from "@/components/commons/ErrorBox.vue"
import NuiButton from "@/components/commons/Button.vue"
import { mapState, mapGetters } from 'vuex'

export default {
  layout: "logined",
  components: {
    ErrorBox,
    NuiButton,
  },
  data() {
    return {
      error: null
    }
  },
  computed: {
    ...mapState('auth0', ['auth0User']),
    ...mapGetters('auth0', ['providers', 'isAuth0Provider'])
  },
  beforeCreate() {
    this.$store.dispatch('setting/setTitle', { title: 'パスワード' })
  },
  methods: {
    async sendChangePasswordEmail() {
      const data = {
        client_id: process.env.AUTH0_CLIENT_ID,
        email: this.auth0User.email,
        connection: 'Username-Password-Authentication'
      }
      const options = {
        headers: {
          'content-type': 'application/json'
        }
      }
      await this.$axios.$post(`https://${process.env.AUTH0_DOMAIN}/dbconnections/change_password`, data, options)
        .then(res => {
          this.$toast.global.instant_success({ 'message': 'メールを送信しました'})
        })
        .catch(err => {
          this.error = err.response
        })
    }
  }
}
</script>