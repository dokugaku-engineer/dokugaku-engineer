# 独学エンジニア - client

client側のソースコード置き場です。
clientはローカルではExpress上で、本番ではnuxt run buildで生成した静的サイトとして動いています。

## 静的サイトをローカルで確認する

ローカルで生成した静的サイトの挙動を確認したい場合は、下記のコマンドを実行します。

```bash
docker-compose exec client npm run build
docker-compose exec client npm run http-server
```

実行後、`http://localhost:8081/`にアクセスすると、プリレンダリングしたファイルの挙動をhttp-serverを利用して確認できます。

## Lint

ESLintを実行します。

```bash
npm run eslint
```

ESLintで自動修正します。

```bash
npm run eslintfix
```

Stylelintを実行します。

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