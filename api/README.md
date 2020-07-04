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

## APIのドキュメンテーション

APIのドキュメントは下記コマンドを実行することで確認できます。

```sh
docker-compose exec api php artisan apidoc:generate
```

コマンドを実行すると、[http://localhost:8080/docs/index.html](http://localhost:8080/docs/index.html)からAPIドキュメントを閲覧することができます。

もし[Postman](https://www.getpostman.com/)を使用されている場合は、`public/docs/collection.json`ファイルをインポートすることでAPIをテストできます。
