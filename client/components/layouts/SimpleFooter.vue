<template>
  <footer class="footer">
    <p class="copyright">
      © 2020 独学エンジニア
    </p>
  </footer>
</template>

<style lang="scss" scoped>
.footer {
  background: $color-white1;
  padding: 3rem 0;
  text-align: center;
}

@media screen and (min-width: 769px) {
  .footer {
    padding: 5rem 0;
  }
}

.copyright {
  font-size: 1rem;
  letter-spacing: 0.05em;
}
</style>
