<template>
  <footer class="footer">
    <ul class="footer-list">
      <li>
        <nuxt-link to="/term"> 利用規約 </nuxt-link>
      </li>
      <li>
        <nuxt-link to="/privacy"> プライバシーポリシー </nuxt-link>
      </li>
      <li>
        <nuxt-link to="/tokutei"> 特定商取引に関する表記 </nuxt-link>
      </li>
      <li>
        <a href="https://forms.gle/bxxmZpgXSP77vWNSA" target="_blank">
          お問い合わせ
        </a>
      </li>
    </ul>
    <p class="copyright">© 2023 独学エンジニア</p>
  </footer>
</template>

<style lang="scss" scoped>
.footer {
  background: $color-white1;
  padding: 3rem 0 2rem;
  text-align: center;
}

@media screen and (min-width: 769px) {
  .footer {
    padding: 5rem 0;
  }
}

.footer-list {
  display: inline-block;
  margin-bottom: 5rem;
  vertical-align: middle;

  li {
    display: inline-block;
    font-size: 1.3rem;
    letter-spacing: 0.05em;
    line-height: 1.8;
    margin: 0 10px;
  }
}

@media screen and (min-width: 769px) {
  .footer-list {
    li {
      font-size: $font-size-sm;
    }
  }
}

.copyright {
  font-size: 1rem;
  letter-spacing: 0.05em;
  padding-bottom: 2rem;
}
</style>
