<template>
  <div class="container">
    <div class="heading">
      <h1 class="heading-title">
        アカウント削除
      </h1>
    </div>
    <main class="main">
      <div v-if="isAuth0Provider && !auth0User.email_verified" class="setting">
        <verification-email-box />
      </div>

      <div v-else>
        <div class="setting">
          <error-box>
            <p>
              アカウント削除は即時反映され、一度削除すると復活できません。これまでのデータはすべて削除されます。
            </p>
            <p>削除しますか？</p>
          </error-box>

          <div v-if="error">
            <error-box>
              <p>
                アカウント削除時にエラーが発生しました。時間をおいた後、ログインし直してから再度お試しください。
              </p>
            </error-box>
          </div>

          <div class="two-btns">
            <link-button to="/course/serverside" class="btn-outline-teal1">
              いいえ
            </link-button>
            <nui-button v-if="submitPending" class="btn-red1">
              <i class="fad fa-spinner fa-spin fa-lg" />
            </nui-button>
            <nui-button v-else class="btn-red1" @click.native="deleteUser">
              はい
            </nui-button>
          </div>
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

.setting {
  padding: 0 2.4rem 2.4rem;
}

@media screen and (min-width: 769px) {
  .setting {
    padding: 0 4rem 4rem;
  }
}

.two-btns {
  display: flex;
  justify-content: space-between;
  margin-top: 3.2rem;

  .btn {
    width: 48%;
  }
}
</style>

<script>
import NuiButton from '@/components/commons/Button.vue'
import ErrorBox from '@/components/commons/ErrorBox.vue'
import LinkButton from '@/components/commons/LinkButton.vue'
import VerificationEmailBox from '@/components/partials/course/VerificationEmailBox.vue'
import { mapState, mapGetters } from 'vuex'

export default {
  layout: 'setting',
  components: {
    NuiButton,
    ErrorBox,
    LinkButton,
    VerificationEmailBox,
  },
  data() {
    return {
      submitStatus: 'OK',
      error: null,
    }
  },
  computed: {
    ...mapState('auth0', ['auth0User']),
    ...mapGetters('auth0', ['userId', 'isAuth0Provider']),
    submitPending() {
      return this.submitStatus === 'PENDING'
    },
  },
  beforeCreate() {
    this.$store.dispatch('setTitle', 'アカウント削除')
  },
  methods: {
    async deleteUser() {
      this.submitStatus = 'PENDING'
      const options = await this.getOptions()
      await this.$axios
        .$delete(`/users/${this.userId}`, options)
        .then(() => {
          this.submitStatus = 'OK'
          this.$toast.global.instant_success({
            message: 'アカウントを削除しました',
          })
        })
        .catch((err) => {
          this.submitStatus = 'ERROR'
          this.error = err.response
          this.$sentry.captureException(err)
        })

      if (this.submitStatus != 'OK') {
        return
      }

      await this.$auth0.logout({ returnTo: window.location.origin })
    },
    async getOptions() {
      const token = await this.$auth0.getTokenSilently()
      return {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    },
  },
  head() {
    return {
      title: 'アカウント削除',
    }
  },
}
</script>
