<template>
  <header class="l-header">
    <h1>
      <logo />
    </h1>
  </header>
</template>

<style lang="scss" scoped>
.l-header {
  background-color: $color-white1;
  padding: 10px 0 2px;
  text-align: center;
}

@media screen and (min-width: 769px) {
  .l-header {
    padding: 17px 0 10px;
  }
}

.l-header-logo {
  width: 170px;
}

@media screen and (min-width: 769px) {
  .l-header-logo {
    width: 222px;
  }
}
</style>

<script>
import Logo from "@/components/svg/Logo.vue"

export default {
  components: {
    Logo
  }
}
</script>
