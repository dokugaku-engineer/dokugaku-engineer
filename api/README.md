# 独学エンジニア

## API

APIの開発を行いたい場合は、下記コマンドを実行し、APIのドキュメントを参照してください。

```sh
docker exec -it dokugaku-engineer_api_1 /bin/bash
php artisan apidoc:generate
```

コマンドを実行すると、[http://localhost:8080/docs/index.html](http://localhost:8080/docs/index.html)からAPIドキュメントを閲覧することができます。

もし[Postman](https://www.getpostman.com/)を使用されている場合は、`public/docs/collection.json`ファイルをインポートすることでAPIをテストできます。
