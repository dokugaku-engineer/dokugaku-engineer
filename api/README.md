# 独学エンジニア - API

## Lint

### PHPStan

下記のコマンドを実行することで、構文エラーがないかを確認できます。

```sh
composer phpstan
```

### PHP_CodeSniffer

下記のコマンドを実行することで、コーディング規約に沿って書いているかを確認できます。

```sh
composer phpcs
```

自動整形するには下記コマンドを実行します。

```sh
composer phpcbf
```

## テスト

マイグレーションを実行する。

```sh
docker-compose exec api php artisan migrate --env=testing
```

テストを実行する。

```sh
docker-compose exec api ./vendor/bin/phpunit
```

## APIのドキュメンテーション

APIのドキュメントは下記コマンドを実行することで確認できます。

```sh
docker-compose exec api php artisan apidoc:generate
```

コマンドを実行すると、[http://localhost:8080/docs/index.html](http://localhost:8080/docs/index.html)からAPIドキュメントを閲覧することができます。

もし[Postman](https://www.getpostman.com/)を使用されている場合は、`public/docs/collection.json`ファイルをインポートすることでAPIをテストできます。

## レクチャー関連のCSVファイル

### ファイルの設置場所

#### ローカル環境

`storage/app/public/lecture` 以下に CSV ファイルを設置する。

#### 本番環境

S3 に CSV ファイルを設置する。

### ファイルを DB にインポートする

```bash
php artisan import:lecture-csv
```

### lecture.csv の description の表記

マークダウン記法で表記する。

#### リンク

URLを貼ればリンクとして表示される。

#### コード

以下のように ``` で囲い、その横に言語を表記する。

```php
<?php
```

#### 折りたたみ表示

::: spoiler 折りたたみウィジェットのラベル

折りたたみ本文

:::
