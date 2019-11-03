<template>
  <div>
    <Header />
    <nuxt />
    <Footer />
  </div>
</template>

<script>
import Header from "@/components/layouts/Header.vue"
import Footer from "@/components/layouts/Footer.vue"

export default {
  components: {
    Header,
    Footer
  }
}
</script>
