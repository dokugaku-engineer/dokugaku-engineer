<template>
  <div class="container">
    <div class="heading">
      <h1 class="heading-title">
        お支払い情報
      </h1>
    </div>
    <main class="main">
      <div v-if="loadingUser" class="loading">
        <i class="fad fa-spinner fa-spin fa-lg" />
      </div>
      <div v-if="error" class="setting-form">
        <error-box>
          <p>
            データ取得時にエラーが発生しました。時間をおいた後、ログインし直してから再度お試しください。
          </p>
        </error-box>
      </div>
      <div
        v-if="isAuth0Provider && !auth0User.email_verified"
        class="setting-form"
      >
        <verification-email-box />
      </div>

      <div v-else>
        <div v-if="!loadingUser && !error">
          <div v-if="subscribed" class="setting-form">
            <p class="setting-title setting-content">
              サーバーサイドコース（有料）
            </p>
            <customer-portal-button />
          </div>
          <div v-else class="setting-form">
            <p class="setting-title">サーバーサイドコース（無料）</p>
            <p class="setting-content">
              無料受講中はコースの一部を学習できます。
              <br />
              有料登録すれば、公開中の全レッスンを学習できるようになります。
            </p>
            <div class="setting-content">
              <div class="subscribe">
                <h4 class="subscribe-title">月額料金</h4>
                <p>{{ price }}円（税込）</p>
              </div>
              <div class="subscribe">
                <h4 class="subscribe-title">利用可能期間</h4>
                <p>
                  登録日から1ヶ月間ご利用いただけます。正確には、登録日の翌月同日同時間までとなります。翌月に同日がない場合は、翌月末日の同時間までとなります。1ヶ月が経つと、自動的に更新されます。
                </p>
              </div>
            </div>
            <subscribe-button />
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

.setting-form {
  padding: 0 2.4rem 2.4rem;
}

@media screen and (min-width: 769px) {
  .setting-form {
    padding: 0 4rem 4rem;
  }
}

.setting-title {
  color: $color-teal1;
  margin-bottom: 1.4rem;
}

.setting-content {
  margin-bottom: 2.4rem;
}

.loading {
  color: $color-teal1;
  left: 47%;
  position: absolute;
}

.subscribe {
  margin-bottom: 1rem;
}

.subscribe-title {
  color: $color-gray2;
  font-size: $font-size-sm;
  letter-spacing: 1.5px;
  margin-bottom: 0.7rem;
}
</style>

<script>
import Meta from '@/assets/mixins/meta'
import ErrorBox from '@/components/commons/ErrorBox.vue'
import VerificationEmailBox from '@/components/partials/course/VerificationEmailBox.vue'
import SubscribeButton from '@/components/partials/settings/SubscribeButton.vue'
import CustomerPortalButton from '@/components/partials/settings/CustomerPortalButton.vue'
import { mapState, mapGetters } from 'vuex'

export default {
  layout: 'setting',
  components: {
    ErrorBox,
    VerificationEmailBox,
    SubscribeButton,
    CustomerPortalButton,
  },
  mixins: CustomerPortalButton[Meta],
  data() {
    return {
      subscribed: false,
      loadingUser: false,
      error: null,
      price: process.env.PRICE,
      meta: {
        title: 'お支払い情報',
      },
    }
  },
  computed: {
    ...mapState('auth0', ['auth0User']),
    ...mapGetters('auth0', ['userId', 'isAuth0Provider']),
  },
  beforeCreate() {
    this.$store.dispatch('setTitle', 'お支払い情報')
  },
  async created() {
    this.loadingUser = true
    const options = await this.getOptions()
    await this.$axios
      .$get(`/subscriptions/${this.userId}`, options)
      .then((res) => {
        if (this.isSubscribing(res)) {
          this.subscribed = true
        }
      })
      .catch((err) => {
        this.error = err.response
        this.$sentry.captureException(err)
      })

    this.loadingUser = false
  },
  methods: {
    async getOptions() {
      const token = await this.$auth0.getTokenSilently()
      return {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    },
    isSubscribing(subscription) {
      if (
        subscription.name === 'serverside' &&
        subscription.stripe_status === 'paid' &&
        (subscription.ends_at === null ||
          this.$dayjs(subscription.ends_at).isAfter(this.$dayjs().format()))
      ) {
        return true
      }
      return false
    },
  },
}
</script>
