# 独学エンジニア - API

## APIのドキュメンテーション

APIのドキュメントは下記コマンドを実行することで確認できます。

```sh
docker exec -it dokugaku-engineer_api_1 /bin/bash
php artisan apidoc:generate
```

コマンドを実行すると、[http://localhost:8080/docs/index.html](http://localhost:8080/docs/index.html)からAPIドキュメントを閲覧することができます。

もし[Postman](https://www.getpostman.com/)を使用されている場合は、`public/docs/collection.json`ファイルをインポートすることでAPIをテストできます。
