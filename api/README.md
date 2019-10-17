# Dokugaku Engineer

## API Development

If you're interested in the development of a api, API documentation is available.

```sh
docker exec -it dokugaku-engineer_api_1 /bin/bash
php artisan apidoc:generate
```

Then, you can find documentation at [http://localhost:8080/api/index.html](http://localhost:8080/api/index.html).

If you use [Postman](https://www.getpostman.com/), you can test API by importing `public/docs/collection.json`.
