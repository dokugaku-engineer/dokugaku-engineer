# 独学エンジニア

## 起動

```bash
git pull

cp docker/nginx/nginx_development.conf docker/nginx/nginx.conf

# clientに移動してローカルでnpm installを行う
cd client
npm install

cd ..

docker-compose up -d --build
```

### データベースの作成

```bash
docker exec -it dokugaku-engineer_api_1 /bin/bash
php artisan migrate
```
