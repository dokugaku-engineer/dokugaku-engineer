# 独学エンジニア - client

client 側のソースコード置き場です。
client はローカルでは Express 上で、本番では `nuxt run build` で生成した静的サイトとして動いています。

## 静的サイトをローカルで確認する

ローカルで生成した静的サイトの挙動を確認したい場合は、下記のコマンドを実行します。

```bash
docker-compose exec client npm run build
docker-compose exec client npm run http-server
```

実行後、`http://localhost:8081/` にアクセスすると、ビルドしたファイルの挙動を http-server を利用して確認できます。

## Lint

ESLint を実行します。

```bash
npm run eslint
```

ESLint で自動修正します。

```bash
npm run eslintfix
```

Stylelint を実行します。

```bash
npm run stylelint
```

## Test

テストを実行します。

```bash
npm run test
```

テストのスナップショットを更新します。

```bash
npm run test:updateSnapshot
```
