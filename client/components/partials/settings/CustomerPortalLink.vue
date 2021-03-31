<template>
  <div>
    <nuxt-link to='' class="confirm-link" @click.native="show">
      お支払い履歴の確認はこちら
    </nuxt-link>
  </div>
</template>

<style lang="scss" scoped>
.confirm-link {
  font-size: $font-size-sm;
}
</style>

<script>
export default {
  methods: {
    async getOptions() {
      const token = await this.$auth0.getTokenSilently()
      return {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    },
    async show(e) {
      e.preventDefault()
      const options = await this.getOptions()
      this.$axios
        .$get('/subscriptions/customer_portal', options)
        .then((res) => {
          window.location.assign(res.url)
        })
        .catch((error) => {
          console.error('Error:', error)
        })
    },
  },
  head: {
    script: [{ src: 'https://js.stripe.com/v3/' }],
  },
}
</script>
