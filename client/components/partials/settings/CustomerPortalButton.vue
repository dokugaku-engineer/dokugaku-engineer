<template>
  <div>
    <nui-button class="btn-teal1 btn-shadow content-btn" @click.native="show">
      詳細を確認する
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
