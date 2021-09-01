<template>
  <div class="content">
    <div class="tagline bg-white2">
      <div class="tagline-img-left">
        <img
          src="@/assets/images/serverside-hero.png"
          alt
          @click="toggleModal"
        />
      </div>
      <div class="tagline-content">
        <div>
          <h1>
            実務で自走するための
            <br />プログラミングロードマップ
            <br />
            <span class="tagline-title">「独学エンジニア」</span>
          </h1>
          <div class="tagline-btn">
            <nui-button
              class="btn-teal1 btn-shadow content-btn"
              @click.native="signup"
            >
              無料で受講する
            </nui-button>
            <nui-button
              class="btn-outline-teal1 btn-shadow content-btn"
              @click.native="showModal = true"
            >
              <i class="fas fa-play-circle fa-lg" />
              講座をプレビュー
            </nui-button>
          </div>
        </div>
        <div class="tagline-img-right">
          <img
            src="@/assets/images/serverside-hero.png"
            alt
            @click="toggleModal"
          />
        </div>
      </div>
    </div>

    <transition name="fade">
      <div v-if="showModal" class="video-modal" @click="toggleModal">
        <div class="video-modal-daialog">
          <div class="video-modal-content">
            <div class="video-modal-embed">
              <iframe
                src="https://player.vimeo.com/video/391168857?autoplay=1&color=26a69a"
                frameborder="0"
                allow="autoplay; fullscreen"
                allowfullscreen
                style="
                  position: absolute;
                  top: 0;
                  left: 0;
                  width: 100%;
                  height: 100%;
                "
                data-ready="true"
              />
            </div>
          </div>
        </div>
      </div>
    </transition>

    <div class="intro bg-white">
      <div class="intro-header">
        <h2>
          技術をちゃんと理解して、実務で自走する
          <br />本格プログラミング講座
        </h2>
        <p>
          「プログラミングを勉強してきたけど、どうコードを書いたらいいかわからない。プログラムが作れない。。」
          <br />
          <br />独学エンジニアは、プログラミング学習経験を持っているけど今後の学習に悩まれている方が、プロのエンジニアになるための本格プログラミング講座です。
          <br />エンジニアとして就職・転職できるようになるのはもちろん、その後の実務で、未知の課題に出会っても自分で情報収集し解決できる実践的スキルが身につきます。
        </p>
      </div>
      <div class="intro-point-container">
        <div class="intro-point">
          <div class="intro-img-container">
            <img
              class="intro-img"
              src="@/assets/images/serverside-feature-illust.png"
              alt
            />
          </div>
          <h3>図解中心の動画で学ぶ</h3>
          <p>
            図解を中心にした動画解説で、イメージをつかみながら理解できます。
            <br />動画は1本20分以内の長さで、集中力を切らさずに学習を進めていけます。
          </p>
        </div>
        <div class="intro-point">
          <div class="intro-img-container">
            <img
              class="intro-img"
              src="@/assets/images/serverside-feature-roadmap.png"
              alt
            />
          </div>
          <h3>実務で必要スキルを網羅</h3>
          <p>
            Web系のサーバーサイドエンジニアとして実務で必要なスキルを網羅しました。
            <br />ロードマップに沿って学習していくので、何を学習すればよいか迷うことはもうありません。
          </p>
        </div>
        <div class="intro-point">
          <div class="intro-img-container">
            <img
              class="intro-img"
              src="@/assets/images/serverside-feature-code.png"
              alt
            />
          </div>
          <h3>実務レベルの演習</h3>
          <p>
            実務で実際にあるような課題を演習として取り組みます。
            <br />経験年数2〜3年のエンジニアレベルの「実務レベルのスキル」を習得します。
          </p>
        </div>
      </div>
    </div>

    <div class="philosophy bg-white2">
      <div class="philosophy-container">
        <h2>サービス名に込めた想い</h2>
        <p>
          プログラミング初学者が自学自習のみで実務レベルの技術力を身につけるのは難しく、そのための道のりも整備されていません。
          <br />
          <br />だからこそ、初学者から実務へのロードマップを整える。
          <br />「初学者が、自分で学びながら実務でやっていけるエンジニアへ」という想いが込められています。
          <br />
          <br />エンジニアとして就職・転職できるのはもちろん、その後の実務で使える実践的スキルを。
        </p>
        <h3 class="philosophy-message">
          「大丈夫、独学でもエンジニアになれる」
        </h3>
        <div class="content-single-btn">
          <nui-button
            class="btn-teal1 btn-shadow content-btn"
            @click.native="signup"
          >
            無料で受講する
          </nui-button>
        </div>
      </div>
    </div>

    <div class="roadmap">
      <div class="roadmap-header">
        <h2>自走するためのロードマップ</h2>
        <p>
          ロードマップのゴールは、実務で未知の課題に出会っても自力で解決していけるWeb系サーバーサイドエンジニアになることです。
          <br />そのために、実務で必要なスキルを1ステップずつ学び、プロジェクトの実装を通じて理解を深めます。
          <br />最後は認定試験として実務で実際にあるようなサービスを構築し、サーバーサイドからデータベース、インフラ、デプロイの実装までを行います。
        </p>
      </div>
      <div class="rodmap-content-wrap">
        <ul>
          <li class="roadmap-content">
            <div class="roadmap-part">
              <h4>アプリケーションの作り方を知ろう</h4>
              <p>
                読書管理サービスを作りながら、アプリケーションの組み立て方とWebサービスの全体像を学びます。また、開発環境（ターミナル、Git、Docker、Visual
                Studio Code）も整えます。
              </p>
            </div>
          </li>
          <li class="roadmap-content">
            <div class="roadmap-part">
              <h4>PHPとオブジェクト指向を学ぼう</h4>
              <p>
                PHPとオブジェクト指向の基本を習得します。デバッグの方法といった、エラーのときにどう対処すればよいかも学びます。同時にコードをたくさん書き、プログラミングに慣れることを狙います。
              </p>
              <ul class="roadmap-project">
                <li>プロジェクト：ブラックジャックゲーム</li>
              </ul>
            </div>
          </li>
          <li class="roadmap-content">
            <div class="roadmap-part">
              <h4>開発ツールを使いこなそう</h4>
              <p>
                開発する上で必須なツールの使い方を学びます。Linuxコマンド、Git・GitHubを利用したコードのバージョン管理、Dockerコンテナでの開発ができるようになります。
              </p>
            </div>
          </li>
          <li class="roadmap-content">
            <div class="roadmap-part">
              <h4>データベースとSQLを学ぼう</h4>
              <p>
                リレーショナルデータベースの概念を学び、基本的な設計方針を身につけます。またSQLを使い、PHPからデータが操作できるようになります。
              </p>
              <ul class="roadmap-project">
                <li>プロジェクト：ログ解析システム</li>
              </ul>
            </div>
          </li>
          <li class="roadmap-content">
            <div class="roadmap-part">
              <h4>フルスクラッチでWebアプリケーションを作ろう</h4>
              <p>
                素のPHPを使用してWebアプリケーションを一から作成します。フルスクラッチで作ることで、Webアプリケーションの仕組みを理解し、自分でWebアプリケーションが作れるようになります。
              </p>
              <ul class="roadmap-project">
                <li>プロジェクト：PHPでブログサービス</li>
              </ul>
            </div>
          </li>
          <li class="roadmap-content">
            <div class="roadmap-part">
              <h4>フレームワーク「Laravel」を学ぼう</h4>
              <p>
                PHPフレームワークのLaravelを利用して、求人サービスを作成します。現場で実際に使われるような細かい機能が実装できるようになります。また、テストについても学びます。
              </p>
              <ul class="roadmap-project">
                <li>プロジェクト：Laravelでブログサービス</li>
              </ul>
            </div>
          </li>
          <li class="roadmap-content">
            <div class="roadmap-part">
              <h4>インフラを構築しよう</h4>
              <p>
                AWSでネットワーク・サーバーを構築します。また、監視やアラートの設定といった、インフラの運用に関する知識も学びます。
              </p>
            </div>
          </li>
          <li class="roadmap-content">
            <div class="roadmap-part">
              <h4>認定試験を受けよう</h4>
              <p>
                実務レベルのサービスを構築し、リリースまで行います。実務水準の技術力の取得を目指すとともに、就職・転職時に活用できるポートフォリオができます。
              </p>
            </div>
          </li>
          <li class="roadmap-content">
            <div class="roadmap-part">
              <h4>Appendix</h4>
              <p>
                セキュリティとアルゴリズム・データ構造について学びます。セキュリティでは主要な脆弱性に対して対策できるようになります。アルゴリズム・データ構造では基本をおさえ、計算量を意識して実装できるようになります。
              </p>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <div class="price">
      <div class="price-card">
        <div class="price-content">
          <h6 class="price-title">
            月額料金
          </h6>
          <span class="price-payable"> ¥{{ price | localprice }} </span>
          <span class="price-label">
            （税込）
          </span>
          <div class="price-btn">
            <nui-button
              class="btn-teal1 btn-shadow content-btn"
              @click.native="signup"
            >
              無料で受講する
            </nui-button>
          </div>
          <div class="price-notice">
            前半の動画は無料で視聴できます。まずは無料でお試しください！
          </div>
        </div>
      </div>
    </div>

    <div class="qa bg-white2">
      <div class="qa-container">
        <div class="qa-content">
          <h2>よくある質問</h2>
          <ul>
            <li class="qa-question">
              受講における必要条件はありますか？
            </li>
            <li class="qa-answer">
              何らかのプログラミング言語の経験と、HTML・CSSの基礎的な知識があると講座をスムーズに受講できます。まだ学習されていない場合は、HTML・CSSについて、入門書かドットインストールやProgateといったプログラミング入門サービスをご覧になった上で受講ください。
            </li>
          </ul>
          <ul>
            <li class="qa-question">
              プログラミングを学んだことがなくても受講できますか？
            </li>
            <li class="qa-answer">
              プログラミングを全くやったことがないという方は進めるのがちょっと難しいかもしれません。本講座は「プログラミングを学びはじめたが、次に何を学ぶべきかわからない」「プログラミングを学んでしばらくたったが、まだまだ自信がもてない」方を想定して作られています。
            </li>
          </ul>
          <ul>
            <li class="qa-question">
              パソコンはWindows、Macのどちらでも大丈夫でしょうか？
            </li>
            <li class="qa-answer">
              Windows（Windows 10 ビルド 19041 以降）、Mac（OS X 10.13
              以降）のどちらもサポートしております。ただし、もしこれから購入される場合はMacをお勧めします。Macの方が開発環境を整えやすく、開発のためのツール類も充実しているためです。そのため講座ではMacを使用して撮影しております。
            </li>
          </ul>
          <ul>
            <li class="qa-question">
              なぜプログラミング言語はPHPなのですか？
            </li>
            <li class="qa-answer">
              初学者がエンジニアとして独り立ちするには、まずはエンジニアとして企業で働く経験を積むのが一番だと考えています。Web系のサーバーサイドエンジニアとしての就職を目下の目標とした場合、求人数で多いのがPHPになります。他の人気言語であるJavaはSIer系の求人が中心で、RubyはPHPと比較すると求人数が少なく、Pythonはデータ分析系の求人が中心です。
            </li>
          </ul>
          <ul>
            <li class="qa-question">
              フロントエンドについては学ばないのですか？
            </li>
            <li class="qa-answer">
              本講座はサーバーサイド向けのコースになるため、フロントエンドの領域（HTML、CSS、JavaScript）についてはカバーしておりません。サーバーサイドとフロントエンドが分かれている現場が一定数あること、またサーバーサイドエンジニアとして必要なフロントエンドの知識は書籍等でも充分学べる（フロントエンドの領域自体は奥が深く高度です）ことから、フロントエンドについては本講座内では取り扱っておりません。
            </li>
          </ul>
          <ul>
            <li class="qa-question">
              無料でも利用できますか？
            </li>
            <li class="qa-answer">
              前半部分の動画は無料で視聴できます。まずは無料登録でお試しください。
            </li>
          </ul>
          <ul>
            <li class="qa-question">
              有料プランを利用できるのは登録日から1ヶ月間ですか？
            </li>
            <li class="qa-answer">
              登録日の翌月同日同時間までご利用いただけます。翌月に同日がない場合は、翌月末日の同時間までとなります。
            </li>
          </ul>
          <ul>
            <li class="qa-question">
              有料プランは自動的に更新されますか？
            </li>
            <li class="qa-answer">
              はい。1ヶ月が経つと自動的に更新されます。
            </li>
          </ul>
          <div class="content-single-btn">
            <nui-button
              class="btn-teal1 btn-shadow content-btn"
              @click.native="signup"
            >
              無料で受講する
            </nui-button>
          </div>
        </div>
      </div>
    </div>
    <share-network />
  </div>
</template>

<style lang="scss" scoped>
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
  padding-top: 4rem;
}

@media screen and (min-width: 769px) {
  .tagline {
    padding-top: 5rem;
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

    h1 {
      font-size: 2.8rem;
      letter-spacing: 0.1rem;
      line-height: 4.5rem;
      margin-right: 3rem;
    }
  }
}

@media screen and (min-width: 1200px) {
  .tagline-content {
    h1 {
      font-size: 3.6rem;
      letter-spacing: 1.2rem;
      line-height: 4.8rem;
      margin-right: 2rem;
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
      margin-right: 0.5rem;
      margin-top: 0;
      padding: 1.2rem 0.6rem;
      width: 17.5rem !important;
    }
  }
}

@media screen and (min-width: 1200px) {
  .tagline-btn {
    .btn {
      margin-right: 2rem;
      padding: 1.2rem 2rem;
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

.video-modal {
  background-color: rgba(0, 0, 0, 0.85);
  height: 100vh;
  left: 0;
  overflow: hidden;
  position: fixed;
  top: 0;
  width: 100vw;
  z-index: 2000;
}

.video-modal-daialog {
  align-items: center;
  display: flex;
  margin: 0.8rem auto;
  max-width: 80%;
  min-height: calc(100% - 1rem);
  position: relative;
}

.video-modal-content {
  position: relative;
  width: 100%;
}

.video-modal-embed {
  position: relative;
  overflow: hidden;

  &::before {
    content: '';
    display: block;
    padding-top: 56.25%;
  }
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease-out;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.intro,
.roadmap {
  margin: 0 auto;
  padding: 6.4rem 2.4rem;
}

@media screen and (min-width: 769px) {
  .intro,
  .roadmap {
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
  .intro-header,
  .roadmap-header {
    margin-bottom: 6.4rem;
  }
}

@media screen and (min-width: 769px) {
  .intro-header,
  .roadmap-header {
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

.philosophy,
.price,
.qa {
  padding: 6.4rem 2.4rem;

  h2 {
    margin-bottom: 3.2rem;
    text-align: center;
  }
}

@media screen and (min-width: 769px) {
  .philosophy,
  .qa {
    padding: 9.6rem 4.6rem 6.4rem;
    text-align: center;

    h2 {
      margin-bottom: 4rem;
    }
  }
}

.philosophy-container,
.qa-container {
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

  &::after {
    background-color: $color-teal1;
    border-radius: 50%;
    content: '';
    height: 0.9rem;
    left: 0;
    position: absolute;
    top: 0;
    transform: translateX(-50%);
    width: 0.9rem;
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

.price {
  background-image: url('~assets/images/pc-coffee.jpeg');
  background-size: cover;
}

.price-card {
  background-color: #fff;
  border-radius: 1rem;
  box-shadow: 5px 5px 25px 0 rgba(46, 61, 73, 0.2);
  margin: 0 auto;
  padding: 4rem 2rem 3rem;
  min-width: 230px;
  width: 80%;
}

@media screen and (min-width: 769px) {
  .price-card {
    min-width: 300px;
    width: 30%;
  }
}

.price-content {
  text-align: center;
}

.price-title {
  font-size: $font-size-xxl;
  line-height: 2.4rem;
  margin-bottom: 3rem;
}

.price-payable {
  font-size: $font-size-xl;
  color: $color-teal2;
  font-weight: 300;
}

.price-label {
  font-size: $font-size-sm;
  font-weight: 600;
}

.price-btn {
  margin: 2rem 0;
}

.price-notice {
  font-size: $font-size-xs;
  margin: 1rem 0 0;
  line-height: 2.4rem;
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

  &::before {
    background-color: $color-black;
    border-radius: 50%;
    content: 'Q';
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

  &::before {
    background-color: $color-red1;
    border-radius: 50%;
    content: 'A';
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
  .qa-question,
  .qa-answer {
    padding-left: 0;
  }
}

.bg-white1 {
  background-color: $color-white1;
}

.bg-white2 {
  background-color: $color-white2;
}

.content-btn {
  width: 20rem;

  i {
    vertical-align: middle;
  }
}
</style>

<script>
import Meta from '@/assets/mixins/meta'
import NuiButton from '@/components/commons/Button.vue'
import ShareNetwork from '@/components/commons/ShareNetwork.vue'
import auth0Middleware from '@/middleware/auth0'
import { mapState } from 'vuex'

export default {
  components: {
    NuiButton,
    ShareNetwork,
  },
  mixins: [Meta],
  data() {
    return {
      showModal: false,
      meta: {
        title: '独学エンジニア - 大丈夫、独学でもエンジニアになれる',
        baseTitle: '',
        description:
          '「技術をちゃんと理解して、実務で自走できるエンジニアになる」ための本格プログラミング講座です。基礎から実務で必要なスキルを網羅。未知の課題に出会っても自分で解決できる実践的スキルが身につきます。',
      },
      price: process.env.PRICE,
    }
  },
  computed: {
    ...mapState('auth0', ['user', 'isAuthenticated']),
  },
  methods: {
    toggleModal() {
      this.showModal = !this.showModal
    },
    async signup() {
      const options = {
        redirect_uri: `${process.env.ORIGIN}/course/serverside`,
        appState: {
          targetUrl: '/course/serverside',
        },
        screen_hint: 'signup',
      }
      await this.$auth0.loginWithRedirect(options)
    },
  },
  middleware: auth0Middleware.protect({
    loginRequired: false,
    authenticatedRedirectUri: '/course/serverside',
  }),
}
</script>
