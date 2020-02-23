# 独学エンジニア

このリポジトリは独学エンジニアのWebサイトのソースコードです。

## 開発

環境変数を設定します。

```bash
cp docker/nginx/nginx.development.conf docker/nginx/nginx.conf
cp docker/db/db-variables.development.env docker/db/db-variables.env
cp api/.env.dev api/.env
cp client/.env.dev client/.env
```

Dockerを起動します。

```bash
docker-compose up -d --build
```

apiでcomposer installを行います。

```bash
docker-compose exec api composer install
```

データベースのマイグレーションを実行します。

```bash
docker-compose exec api php artisan migrate
```

レクチャー関連のデータを追加します。

```bash
docker-compose exec api php artisan import:lecture-csv
```

これでサイトにアクセスできます。

[http://localhost:3333/](http://localhost:3333/)
