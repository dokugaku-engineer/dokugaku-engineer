<template>
  <error-box>
    <p>メールアドレスの認証が完了していません。コースを受講するにはメールアドレスの認証を行ってください。</p>
    <p>認証用メールを送信するには<a href="" class="error-box-link" @click.prevent="sendVerificationEmail">こちらをクリック</a>してください。</p>
  </error-box>
</template>

<style lang="scss" scoped>
.error-box-link {
  color: $color-blue;
}
</style>

<script>
import ErrorBox from "@/components/commons/ErrorBox.vue"
import { mapState } from 'vuex'

export default {
  components: {
    ErrorBox
  },
  computed: {
    ...mapState('auth0', ['user'])
  },
  methods: {
    async sendVerificationEmail() {
      const data = {
        'user_id': this.user.sub
      }
      const token = await this.$auth0.getTokenSilently()
      const options = {
        headers: {
          Authorization: `Bearer ${token}`
        }
      }
      await this.$axios.$post('/auth0/send_verification_email', data, options)
        .catch((error) => {
          this.auth0Error = error.response
        })
    }
  },
}
</script>