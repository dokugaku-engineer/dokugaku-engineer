# ローカルで開発する

clientは本番ではnuxt generateでプリレンダリングした静的サイトとして動いています。
ローカルでプリレンダリングでの挙動を確認したい場合は、下記のコマンドを実行します。

```bash
docker-compose exec npm run generate
docker-compose exec npm run http-server
```

実行後、`http://localhost:8081/`にアクセスすると、プリレンダリングしたファイルの挙動をhttp-serverを利用して確認できます。
