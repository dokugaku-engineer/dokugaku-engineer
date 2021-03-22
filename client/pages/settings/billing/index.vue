<template>
  <div>
    <button @click="checkout">Submit Payment</button>
  </div>
</template>

<script>

export default {
  layout: 'setting',
  head: {
    script: [{ src: 'https://js.stripe.com/v3/' }]
  },
  data() {
    return {
      meta: {
        title: 'お支払い情報',
      },
    }
  },
  methods: {
    async checkout() {
      const token = await this.$auth0.getTokenSilently()
      const options = {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
      const stripe = Stripe(process.env.STRIPE_PUBLISHABLE_KEY)
      await this.$axios
        .$post('/subscriptions/create_checkout_sessions', {
          price_id: process.env.STRIPE_PRICE_ID
        }, options)
        .then((res) => {
          stripe.redirectToCheckout({
            sessionId: res['sessionId']
          })
        });
    }
  }
}
</script>
