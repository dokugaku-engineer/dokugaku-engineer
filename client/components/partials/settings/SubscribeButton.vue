<template>
  <div>
    <nui-button
      class="btn-teal1 btn-shadow content-btn"
      @click.native="checkout"
    >
      有料登録する
    </nui-button>
  </div>
</template>

<style lang="scss" scoped>
.content-btn {
  width: 25rem;
}
</style>

<script>
import NuiButton from '@/components/commons/Button.vue'

export default {
  components: {
    NuiButton,
  },
  beforeCreate() {
    this.$store.dispatch('setTitle', 'お支払い情報')
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
    async checkout() {
      const options = await this.getOptions()
      const stripe = Stripe(process.env.STRIPE_PUBLISHABLE_KEY) // eslint-disable-line no-undef
      await this.$axios
        .$post(
          '/subscriptions/create_checkout_sessions',
          {
            price_id: process.env.STRIPE_PRICE_ID,
          },
          options
        )
        .then((res) => {
          stripe.redirectToCheckout({
            sessionId: res['sessionId'],
          })
        })
    },
  },
  head: {
    script: [{ src: 'https://js.stripe.com/v3/' }],
  },
}
</script>
