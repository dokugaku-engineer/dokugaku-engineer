<template>
  <div class="container">
    <header class="header fixed-top bg-white1">
      <a href="" class="header-logo">
        <logo />
      </a>
      <header-menu />
      <div class="header-menu">
        <a href="" class="header-link">ログイン</a>
        <nui-button class="btn-teal1 btn-xs btn-shadow-all header-link header-btn">無料で受講</nui-button>
      </div>
    </header>

    <div class="content">
      <div class="tagline bg-white2">
        <div class="tagline-img-left">
          <img
            src="@/assets/images/serverside-hero.png"
            alt=""
          />
        </div>
        <div class="tagline-content">
          <div>
            <h1>
              実務で自走するための
              <br>
              プログラミングロードマップ
              <br>
              <span class="tagline-title">「独学エンジニア」</span>
            </h1>
            <div class="tagline-btn">
              <nui-button class="btn-teal1 btn-shadow content-btn" submit="true">
                無料で受講する
              </nui-button>
              <nui-button class="btn-outline-teal1 btn-shadow content-btn" submit="true">
                <i class="fas fa-play-circle fa-lg"></i>
                講座をプレビュー
              </nui-button>
            </div>
          </div>
          <div class="tagline-img-right">
            <img
              src="@/assets/images/serverside-hero.png"
              alt=""
            />
          </div>
        </div>
      </div>

      <div class="intro bg-white">
        <div class="intro-header">
          <h2>
            オンラインプログラミング学習スクール
            <br>
            『独学エンジニア』
          </h2>
          <p>
            独学エンジニアは実務で自走できるエンジニアになるためのオンラインプログラミング学習スクールです。
            <br>
            エンジニアとして就職・転職できるようになるのはもちろん、その後の実務で、未知の課題に出会っても自分で情報収集し解決できる実践的スキルが身に付きます。
          </p>
        </div>
        <div class="intro-point-container">
          <div class="intro-point">
            <div class="intro-img-container">
              <img
                class="intro-img"
                src="@/assets/images/serverside-feature-illust.png"
                alt=""
              />
            </div>
            <h3>図解中心の動画で学ぶ</h3>
            <p>
              図解を中心にした動画解説で、イメージをつかみながら理解できます。
              <br>
              動画は1本15分以内の長さで、集中力を切らさずに学習を進めていけます。
            </p>
          </div>
          <div class="intro-point">
            <div class="intro-img-container">
              <img
                class="intro-img"
                src="@/assets/images/serverside-feature-roadmap.png"
                alt=""
              />
            </div>
            <h3>実務で必要スキルを網羅</h3>
            <p>
              WEB系のサーバーサイドエンジニアとして実務で必要なスキルだけを網羅しました。
              <br>
              ロードマップに沿って学習していくので、何を学習すればよいか迷うことはもうありません。
            </p>
          </div>
          <div class="intro-point">
            <div class="intro-img-container">
              <img
                class="intro-img"
                src="@/assets/images/serverside-feature-code.png"
                alt=""
              />
            </div>
            <h3>実務レベルの演習</h3>
            <p>
              実務で実際にあるような課題を演習として取り組みます。
              <br>
              経験年数2〜3年のエンジニアレベルの「実務レベルのスキル」を習得します。
            </p>
          </div>
        </div>
      </div>

      <div class="philosophy bg-white2">
        <div class="philosophy-container">
          <h2>サービス名に込めた想い</h2>
          <p>
            プログラミング初学者が自学自習のみで実務レベルの技術力を身に付けるのは難しく、そのための道のりも整備されていません。
            <br>
            <br>
            だからこそ、初学者から実務へのロードマップを整える。
            <br>
            「初学者が、自分で学びながら実務でやっていけるエンジニアへ」という想いが込められています。
            <br>
            <br>
            エンジニアとして就職・転職できるのはもちろん、その後の実務で使える実践的スキルを。
          </p>
          <h3 class="philosophy-message">「初学者から実務で自走できるエンジニアへ」</h3>
          <div class="content-single-btn">
            <nui-button class="btn-teal1 btn-shadow content-btn" submit="true">
              無料で受講する
            </nui-button>
          </div>
        </div>
      </div>

      <div class="roadmap">
        <div class="roadmap-header">
          <h2>
            自走するためのロードマップ
          </h2>
          <p>
            ロードマップのゴールは、実務で未知の課題に出会っても自力で解決していけるWEB系サーバーサイドエンジニアになることです。
            <br>
            そのために、実務で必要なスキルを1ステップずつ学び、プロジェクトの実装を通じて理解を深めます。
            <br>
            最後は認定試験として実務で実際にあるようなサービスを構築し、サーバーサイドからデータベース、インフラ、デプロイの実装までを行います。
          </p>
        </div>
        <div class="rodmap-content-wrap">
          <ul>
            <li class="roadmap-content">
              <div class="roadmap-part">
                <h4>アプリケーションの作り方を知ろう</h4>
                <p>読書管理サービスを作りながら、アプリケーションの組み立て方とWEBサービスの全体像を学びます。また、開発環境（ターミナル、Docker、Visual Studio Code）も整えます。</p>
              </div>
            </li>
            <li class="roadmap-content">
              <div class="roadmap-part">
                <h4>PHPとオブジェクト指向を学ぼう</h4>
                <p>PHPとオブジェクト指向の基本を習得します。デバッグの方法といった、エラーのときにどう対処すればよいかも学びます。同時にコードをたくさん書き、プログラミングに慣れることを狙います。</p>
                <ul class="roadmap-project">
                  <li>プロジェクト：ブラックジャックゲーム</li>
                </ul>
              </div>
            </li>
            <li class="roadmap-content">
              <div class="roadmap-part">
                <h4>Linuxコマンドラインを使いこなそう</h4>
                <p>Linuxの必須コマンドを手を動かしながら習得します。今後の開発がスムーズにできるよう、ターミナルの操作とLinuxの操作ができるようになります。</p>
              </div>
            </li>
            <li class="roadmap-content">
              <div class="roadmap-part">
                <h4>データベースとSQLを学ぼう</h4>
                <p>リレーショナルデータベースの概念を学び、基本的な設計方針を身に付けます。またSQLを使い、PHPからデータが操作できるようになります。</p>
                <ul class="roadmap-project">
                  <li>プロジェクト：ログ解析システム</li>
                </ul>
              </div>
            </li>
            <li class="roadmap-content">
              <div class="roadmap-part">
                <h4>Gitでバージョン管理しよう</h4>
                <p>Gitの基本コマンド、ブランチやマージ、コンフリクトの解消方法、GitHubを利用した開発フローなど、チーム開発に必要なGitの基本を学びます。コードがバージョン管理できるようになることに加え、チーム開発の現場でGitが使いこなせるようになります。</p>
              </div>
            </li>
            <li class="roadmap-content">
              <div class="roadmap-part">
                <h4>WEBアプリケーションを一から作成しよう</h4>
                <p>素のPHPを使用してWEBアプリケーションを一から作成します。フルスクラッチで作ることで、WEBアプリケーションの仕組みを理解し、自分でWEBアプリケーションが作れるようになります。</p>
                <ul class="roadmap-project">
                  <li>プロジェクト：PHPでブログサービス</li>
                </ul>
              </div>
            </li>
            <li class="roadmap-content">
              <div class="roadmap-part">
                <h4>読みやすいコードを書こう</h4>
                <p>理解しやすいコードを書く方法を学びます。名前の付け方やコメントの書き方、コードをわかりやすくするベストプラクティスを学習し、コードが読みやすくなるようにします。</p>
              </div>
            </li>
            <li class="roadmap-content">
              <div class="roadmap-part">
                <h4>フレームワーク「Laravel」を学ぼう</h4>
                <p>PHPフレームワークのLaravelを利用して、受付システムを作成します。現場で実際に使われるような細かい機能が実装できるようになります。また、テストについても学びます。</p>
                <ul class="roadmap-project">
                  <li>プロジェクト：Laravelでブログサービス</li>
                </ul>
              </div>
            </li>
            <li class="roadmap-content">
              <div class="roadmap-part">
                <h4>インフラを構築しよう</h4>
                <p>AWSでネットワーク・サーバーを構築します。また、監視やアラートの設定といった、インフラの運用に関する知識も学びます。</p>
              </div>
            </li>
            <li class="roadmap-content">
              <div class="roadmap-part">
                <h4>認定試験を受けよう</h4>
                <p>実務レベルのサービスを構築し、リリースまで行います。実務水準の技術力の取得を目指すとともに、就職・転職時に活用できるポートフォリオができます。</p>
              </div>
            </li>
          </ul>
        </div>
      </div>

      <div class="qa bg-white2">
        <div class="qa-container">
          <div class="qa-content">
            <h2>よくある質問</h2>
            <ul>
              <li class="qa-question">受講における必要条件はありますか？</li>
              <li class="qa-answer">何らかのプログラミング言語の経験と、HTML・CSSの基礎的な知識があると講座をスムーズに受講できます。まだ学習されていない場合は、HTML・CSSについて、入門書かドットインストールやProgateといったプログラミング入門サービスをご覧になった上で受講ください。</li>
            </ul>
            <ul>
              <li class="qa-question">パソコンはWindows、Macのどちらでも大丈夫でしょうか？</li>
              <li class="qa-answer">Windows、Macのどちらもサポートしております。ただし、もしこれから購入される場合はMacをお勧めします。Macの方が開発環境を整えやすく、開発のためのツール類も充実しているためです。そのため講座ではMacを使用して撮影しております。</li>
            </ul>
            <ul>
              <li class="qa-question">なぜプログラミング言語はPHPなのですか？</li>
              <li class="qa-answer">初学者がエンジニアとして独り立ちするには、まずはエンジニアとして企業で働く経験を積むのが一番だと考えています。WEB系のサーバーサイドエンジニアとしての就職を目下の目標とした場合、求人数で多いのがPHPになります。他の人気言語であるJavaはSIer系の求人が中心で、RubyはPHPと比較すると求人数が少なく、Pythonはデータ分析系の求人が中心です。</li>
            </ul>
            <ul>
              <li class="qa-question">料金はかかりますか？</li>
              <li class="qa-answer">現在はβ版としてリリースしているため、期間限定で無料となっております。将来的には有料化する予定ですので、早めの受講をお勧めします。</li>
            </ul>
            <div class="content-single-btn">
              <nui-button class="btn-teal1 btn-shadow content-btn" submit="true">
                無料で受講する
              </nui-button>
           </div>
          </div>
        </div>
      </div>

    </div>

    <Footer />
  </div>
</template>

<style lang="scss" scoped>
.container {
  overflow-x: hidden;
}

.header {
  align-items: center;
  box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
  display: flex;
  padding: 1.6rem .8rem 1rem 2rem;
}

@media screen and (min-width: 769px) {
  .header {
    padding: 2rem 3.2rem;
  }
}

.header-menu {
  display: none;
}

@media screen and (min-width: 769px) {
  .header-menu {
    display: block;
    text-align: right;
    width: 100%;
  }
}

.header-logo {
  width: 100%;
}

.header-link {
  font-size: $font-size-sm;
  letter-spacing: .2rem;
  margin: 0 1.6rem;
}

.header-btn {
  font-weight: 700;
  height: 3.2rem;
  line-height: 3.2rem;
  min-width: 12rem;
  padding: 0 1rem;
  text-align: center;
}

.content {
  h2 {
    font-size: $font-size-xxl;
    font-weight: 700;
    margin-bottom: 1.6rem;
  }
}

@media screen and (min-width: 769px) {
  .content {
    letter-spacing: 0.16rem;
    line-height: 1.7142857143;
  
    h2 {
      font-size: 3.2rem;
    }
  }
}

.tagline {
  align-items: center;
  padding-top: 10rem;
}

@media screen and (min-width: 769px) {
  .tagline {
    padding-top: 0;
  }
}

.tagline-content {
  padding: 0 2.7rem 6.4rem;

  h1 {
    font-size: 2.2rem;
    font-weight: 700;
    line-height: 3.7rem;
  }
}

@media screen and (min-width: 769px) {
  .tagline-content {
    display: flex;
    justify-content: center;
    padding-bottom: 4rem;
    padding-left: 3%;
    padding-right: 7%;
    padding-top: 12rem;

    h1 {
      font-size: 3.6rem;
      letter-spacing: 1.2rem;
      line-height: 4.8rem;
      margin-right: 3rem;
    }
  }
}

.tagline-title {
  margin-left: -1.2rem;
}

.tagline-btn {
  margin-top: 2rem;

  .btn {
    margin-top: 1rem;
    width: 100%;
  }
}

@media screen and (min-width: 769px) {
  .tagline-btn {
    margin-top: 3rem;

    .btn {
      margin-right: 2rem;
      margin-top: 0;
      width: 20rem !important;
    }
  }
}

.tagline-img-left {
  margin-right: -3rem;
  margin-bottom: 3rem;
}


@media screen and (min-width: 769px) {
  .tagline-img-left {
    display: none;
  }
}

.tagline-img-right {
  display: none;
}

@media screen and (min-width: 769px) {
  .tagline-img-right {
    display: block;
    max-width: 46%;
  }
}

.intro, .roadmap {
  margin: 0 auto;
  padding: 6.4rem 2.4rem;
}

@media screen and (min-width: 769px) {
  .intro, .roadmap {
    max-width: 114rem;
    padding: 9.6rem 4.6rem 6.4rem;
  }
}

.intro-header {
  margin-bottom: 1.2rem;
}

.roadmap-header {
  margin-bottom: 4.8rem;
}

@media screen and (min-width: 769px) {
  .intro-header, .roadmap-header {
    margin-bottom: 6.4rem;
  }
}


@media screen and (min-width: 769px) {
  .intro-header, .roadmap-header {
    text-align: center;
  }
}

.intro-point-container {
  display: flex;
  flex-wrap: wrap;
  margin-top: 1.5rem;
}

.intro-point {
  flex: 0 0 100%;
  margin: 3.6rem 0 0 0;
  max-width: 100%;

  h3 {
    font-size: $font-size-lg;
    font-weight: 700;
    margin: 1.6rem 0 2.4rem;
  }
}

@media screen and (min-width: 769px) {
  .intro-point {
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
    padding: 0 3.2rem 3.2rem;
    
    h3 {
      font-size: $font-size-xxxl;
      margin: 2.4rem 0 2.4rem;
    }
  }
}

.intro-img-container {
  display: block;
  text-align: center;
  width: 100%;
}

.intro-img {
  height: auto;
  width: 100%;
  vertical-align: middle;
}

.philosophy, .qa {
  padding: 6.4rem 2.4rem;

  h2 {
    margin-bottom: 3.2rem;
    text-align: center;
  }
}

@media screen and (min-width: 769px) {
  .philosophy, .qa {
    padding: 9.6rem 4.6rem 6.4rem;
    text-align: center;
  
    h2 {
      margin-bottom: 4rem;
    }
  }
}

.philosophy-container, .qa-container {
  margin-left: auto;
  margin-right: auto;
  max-width: 114rem;
}

.philosophy-message {
  color: $color-teal1;
  font-size: 2.4rem;
  margin-top: 3.2rem;
  text-align: center;
}


@media screen and (min-width: 769px) {
  .philosophy-message {
    color: $color-teal1;
    font-size: 3.6rem;
    margin-top: 4rem;
  }
}

.content-single-btn {
  margin-top: 3.2rem;

  .btn {
    width: 100%;
  }
}


@media screen and (min-width: 769px) {
  .content-single-btn {
    margin-top: 4rem;

    .btn {
      width: 20rem;
    }
  }
}

.roadmap-header {
  margin-bottom: 3.2rem;
}

@media screen and (min-width: 769px) {
  .roadmap-header {
    margin-bottom: 6.4rem;
  }
}

.rodmap-content-wrap {
  margin-left: auto;
  margin-right: auto;
  max-width: 97rem;
  padding-top: 1rem;
}

.roadmap-content {
  border-left: 1px solid $color-gray1;
  padding: 0 0 1.6rem 2.4rem;
  position: relative;

  &:after {
    background-color: $color-teal1;
    border-radius: 50%;
    content: '';
    height: .9rem;
    left: 0;
    position: absolute;
    top: 0;
    transform: translateX(-50%);
    width: .9rem;
  }
}

@media screen and (min-width: 769px) {
  .roadmap-content {
    padding: 0 0 4.8rem 4.8rem;
  }
}

.roadmap-part {
  bottom: 1rem;
  position: relative;

  h4 {
    margin-bottom: 1.2rem;
  }

  p {
    margin-bottom: 1.2rem;
  }
}

@media screen and (min-width: 769px) {
  .roadmap-part {
    
    h4 {
      font-size: $font-size-lg;
    }
  }

}

.roadmap-project {
  list-style: disc;
  padding-left: 1.8rem;
}

.qa-content {
  flex: 0 0 100%;
  margin-left: auto;
  margin-right: auto;

  ul {
    border-bottom: 1px solid $color-gray1;
    line-height: 2.8rem;
    margin-bottom: 3.2rem;
    margin-left: -0.8rem;
    padding-bottom: 2.4rem;
    padding-left: 4rem;
    text-align: left;
  }
}

@media screen and (min-width: 769px) {
  .qa-content {
    flex: 0 0 66.666667%;
    max-width: 66.666667%;
  }
}

.qa-question {
  margin-bottom: 1.6rem;
  padding-left: 1rem;

  &:before {
    background-color: $color-black;
    border-radius: 50%;
    content: "Q";
    color: $color-white1;
    display: inline-block;
    font-weight: 700;
    height: 30px;
    margin-left: -4rem;
    margin-right: 1.2rem;
    text-align: center;
    width: 30px;
  }
}

.qa-answer {
  margin-bottom: 1.6rem;
  padding-left: 1rem;

  &:before {
    background-color: $color-red1;
    border-radius: 50%;
    content: "A";
    color: $color-white1;
    display: inline-block;
    font-weight: 700;
    height: 30px;
    margin-left: -4rem;
    margin-right: 1.2rem;
    text-align: center;
    width: 30px;
  }
}

@media screen and (min-width: 769px) {
  .qa-question, .qa-answer {
    padding-left: 0;
  }
}


.fixed-top {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  z-index: 10;
}

.bg-white1 {
  background-color: $color-white1;
}

.bg-white2 {
  background-color: $color-white2;
}

.content-btn {
  width: 20rem;
}
</style>

<script>
import Logo from "@/components/svg/Logo.vue"
import HeaderMenu from "@/components/commons/HeaderMenu.vue"
import NuiButton from "@/components/commons/Button.vue"
import Footer from "@/components/layouts/Footer.vue"

export default {
  components: {
    Logo,
    HeaderMenu,
    NuiButton,
    Footer
  },
  data() {
    return {
      showMenu: false
    }
  }
}
</script>