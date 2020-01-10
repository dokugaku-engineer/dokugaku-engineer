# 独学エンジニア

## 起動

環境変数を設定します。

```bash
cp docker/nginx/nginx_development.conf docker/nginx/nginx.conf
cp docker/db/db-variables.development.env docker/db/db-variables.env
cp api/.evn.development api/.env
cp client/.env.development client.env
```

clientに移動してローカルでnpm installを行います。

```bash
cd client
npm install
cd ..
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

これでサイトにアクセスできます。

[http://localhost:3000/](http://localhost:3000/)
