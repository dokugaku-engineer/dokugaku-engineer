<p align="center"><img src="https://dokugaku-engineer-public-file.s3-ap-northeast-1.amazonaws.com/logo.png"></p>

[独学エンジニア](https://dokugaku-engineer.com/)はプログラミング初学者が自走できるエンジニアになるためのプログラミングスクールです。

## 概要

独学エンジニアはプログラミング初学者のためのオンラインプログラミング学習スクールです。Webベースのアプリケーションで、クライアントサイドはNuxt.jsで、APIはLaravelで書かれています。

### 目的

独学エンジニアは、プログラミング初学者が自走できるエンジニアになることを目標としています。エンジニアとして就職・転職できるようになるのはもちろん、その後の実務で、未知の課題に出会っても自分で情報収集し解決できる実践的スキルの習得を目指します。

プログラミング学習には本やWebページなど、多くの教材があります。しかし実務で自走できるようになるための情報はまとまっていません。また、実務で実際にあるような課題に取り組む機会もありません。独学エンジニアでは実務で必要なスキルをロードマップとして整備し、また実践的な演習を行うことで、実務レベルのスキルを習得します。

### 特徴

* 動画教材の閲覧
* 動画教材のインポート
* アカウント情報の管理
* REST API
* Auth0を利用したユーザー認証
* ソーシャルログイン

## 開発するには

### アプリケーションの起動

以下のコマンドを実行してアプリケーションを起動します。

```bash
# 環境変数の設定
cp docker/nginx/nginx.development.conf docker/nginx/nginx.conf
cp docker/db/db-variables.development.env docker/db/db-variables.env
cp api/.env.dev api/.env
cp client/.env.dev client/.env

# Dockerの起動
docker-compose up -d --build

# APIでライブラリのインストール
docker-compose exec api composer install

# データベースのマイグレーション
docker-compose exec api php artisan migrate

# レクチャー関連のデータのインポート（2回実行する）
docker-compose exec api php artisan import:lecture-csv
```

これでサイトにアクセスできます。

[http://localhost:3333/](http://localhost:3333/)

### ユーザー認証の設定

Auth0を利用してユーザー認証を管理しています。開発にあたって、Auht0の登録、設定を行います。


#### 1. Auth0のアカウントの開設

Auth0にサインアップします。

#### 2. テナントの作成

Create tenant をクリックし、テナントを作成します。

* Tenant Domain：任意の名前
* Region：US

#### 3. 言語の設定

Settings > General をクリックし、言語を設定します。

* Default Language で Japanese(ja) を選択
* Supported Languages で Japanese(ja), English(en) をチェック

#### 4. APIの作成

APIs > CREATE API をクリックし、APIを作成します。

* Name：Dokugaku Engineer API
* Identifier：http://localhost:3333/api
* Signing Algorithm：RS256

#### 5. アプリケーションの作成

Applications > CREATE APPLICATION をクリックし、アプリケーションを作成します。

* Name：Dokugaku Engineer
* application type：Single Page Web Applications

Applications > Dokugaku Engineer > Settings をクリックし、アプリケーションの設定を行います。

* Allowed Callback URLs：http://localhost:3333,http://localhost:3333/course/serverside,http://localhost:3333/registration
* Allowed Logout URLs：http://localhost:3333
* Allowed Web Origins：http://localhost:3333

#### 6. ルールの作成

トークンのスコープを検証するルールを作成します。Rules > CREATE RULE > Empty rule をクリックします。

* Name：Access Token Scopes
* Script：Auth0/rules/access_token_scopes.js のコードを貼り付ける

ユーザーデータをトークンに追加するルールを作成します。Rules > CREATE RULE > Empty rule をクリックします。

* Name：Add user data to tokens
* Script：Auth0/rules/add_userdata_to_tokens.js のコードを貼り付ける

#### 7. ソーシャルコネクトの対応

Connections > Social をクリックする。
Googleのチェックを外し、GitHubとTwitterをチェックする。

GitHubとTwitterの設定についてはAuth0のドキュメントを参考にする。

* [Connect your app to GitHub](https://auth0.com/docs/connections/social/github)
* [Connect Your App to Twitter](https://auth0.com/docs/connections/social/twitter)

#### 8. ユニバーサルログインの使用

Universal Login > Settings をクリックして、新ユニバーサルログインページを使用するように設定する。

* Experience：New

#### 9. 環境変数の設定

api/.env に下記を設定する。

```api/.env
AUTH0_AUDIENCE=http://localhost:3333/api
AUTH0_DOMAIN=${テナント名}.auth0.com
AUTH0_MANAGEMENT_API_AUDIENCE=${Auth0 Management APIのIdentifier}
AUTH0_MANAGEMENT_API_CLIENT_ID=${Auth0 Management APIがAUTHORIZEDしているApplicationのClient ID}
AUTH0_MANAGEMENT_API_CLIENT_SECRET=${Auth0 Management APIがAUTHORIZEDしているApplicationのClient Secret}
}
AUTH0_NAMESPACE=https://dokugaku-engineer.com/
```

client/.env に下記を設定する。

```client/.env
AUTH0_AUDIENCE=http://localhost:3333/api
AUTH0_CLIENT_ID=${作成したApplicatiopnのClient ID}
AUTH0_DOMAIN=${テナント名}.auth0.com
AUTH0_MANAGEMENT_API_AUDIENCE=${Auth0 Management APIのIdentifier}
AUTH0_MANAGEMENT_API_CLIENT_ID=${Auth0 Management APIがAUTHORIZEDしているApplicationのClient ID}
AUTH0_MANAGEMENT_API_CLIENT_SECRET=${Auth0 Management APIがAUTHORIZEDしているApplicationのClient Secret}
AUTH0_NAMESPACE=https://dokugaku-engineer.com/
```

## Mission, Vision, Value

### Mission

* 本気でキャリアを変えたい人の力になる

### Vision

* プログラミング初学者が実務で自走できるエンジニアになれる道を整備する

### Value

* 高品質な教材のみを提供しよう
* 人の可能性を信じよう

### なぜオープンソースなのか

プログラミングを習得する上で、実際に運用しているWebサービスのソースコードを読むことは大変勉強になります。一方で、運用しているWebサービスのソースコードは公開してないものが多く、プログラミング初学者が参考にしやすいものは少ないです。そこで独学エンジニアではソースコードを公開し、プログラミング初学者が実際に運用中のWebサービスのソースコードに触れる機会を提供することで、プログラミング初学者の学習の参考になればと願っています。

また、オープンソースにコミットすることは最初はハードルが高いです。独学エンジニアで学習された方がオープンソースにコミットする練習の場として機能し、プログラミング初学者がオープンソースに触れるきっかけになればと思っています。
