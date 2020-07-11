<template>
  <static-page>
    <section>
      <h1>特定商取引に関する表記</h1>
      <p>
        「特定商取引に関する法律」第11条（通信販売についての広告）等に基づき以下に明示いたします。
      </p>
      <section>
        <h3>販売業者</h3>
        <p>山浦清透</p>
      </section>
      <section>
        <h3>メールアドレス</h3>
        <p>support(at)dokugaku-engineer.com</p>
      </section>
      <section>
        <h3>お問合わせ先</h3>
        <p>お問い合わせ先をご覧ください。</p>
      </section>
      <section>
        <h3>販売価格</h3>
        <p>各商品に表記された価格に準じます。</p>
      </section>
      <section>
        <h3>販売価格以外の料金</h3>
        <p>
          商品価格に税金も含まれておりますので販売価格以外の料金はかかりません。
        </p>
      </section>
      <section>
        <h3>注文方法</h3>
        <p>インターネット</p>
      </section>
      <section>
        <h3>支払方法</h3>
        <p>クレジットカード支払いによる月額課金方式（前払い）になります。</p>
      </section>
      <section>
        <h3>支払時期</h3>
        <p>
          各社クレジットカードによる決済時期によります。ご利用されるカード会社までお問い合わせください。
        </p>
      </section>
      <section>
        <h3>サービス提供の時期</h3>
        <p>
          代金決済手続きの完了確認後直ぐにご利用頂けます。
        </p>
      </section>
      <section>
        <h3>返金・キャンセルについて</h3>
        <p>
          サービスの特性上、返金・キャンセルは受け付けておりません。
        </p>
      </section>
      <section>
        <h3>不良品の取扱条件</h3>
        <p>
          商品がご利用できない場合は、お問い合わせフォームよりお問い合わせ下さい。
        </p>
      </section>
      <section>
        <h3>動作環境</h3>
        <ul class="disc">
          <li>
            OS：Microsoft Windows 10 ビルド 19041 以降、Mac OS X 10.13 以降
          </li>
          <li>
            Webブラウザ：GoogleChrome（最新版）
          </li>
          <li>
            CPU：上記OSが推奨する稼働環境に準じます。
          </li>
          <li>
            メモリ：8GB以上
          </li>
          <li>
            ハードディスクの空き容量：10GB以上
          </li>
        </ul>
      </section>
      <section class="note">
        <p>
          消費者からの請求がある場合、広告表示事項を記載した書面又は電子メール等を遅滞なく提供いたします。
        </p>
      </section>
    </section>
  </static-page>
</template>

<style lang="scss" scoped>
.disc {
  li {
    list-style-position: inside;
    list-style-type: disc;
  }
}

.note {
  margin-top: 4rem;
}
</style>

<script>
import StaticPage from '@/components/partials/static/StaticPage.vue'

export default {
  components: {
    StaticPage,
  },
  head () {
    return {
      title: '特定商取引に関する表記',
    }
  },
  beforeCreate() {
    this.$store.dispatch('setTitle', '特定商取引に関する表記')
  },
}
</script>
