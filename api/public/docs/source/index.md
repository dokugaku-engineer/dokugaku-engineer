---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost:8080/docs/collection.json)

<!-- END_INFO -->
本ドキュメントは独学エンジニアの公式APIのドキュメントです。[Laravel API Documentation Generator](https://github.com/mpociot/laravel-apidoc-generator)を使用して生成しています。
何か間違いを発見したり改善を加えたい場合は、イシューを立てるかプルリクエストを送信してください。

## エラーハンドリング

### エラーレスポンス

APIリクエストに失敗すると、下記の形式のエラーレスポンスが返されます。

{
  "error": {
    "message": "不正なクエリ",
    "code": 30
  }
}

* message: エラー内容の説明。
* code: エラーコード。値は下記に記載。

#### エラーコード

| コード | 内容                               |
| :----- | :--------------------------------- |
| 30     | データ保存時のバリデーションエラー |
| 40     | 無効なクエリ                       |


#1. Category


<!-- START_109013899e0bc43247b0f00b67f889cf -->
## カテゴリー一覧を取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/categories?except=consequatur" 
```

```javascript
const url = new URL("http://localhost:8080/api/categories");

    let params = {
            "except": "consequatur",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "name": "Sample1",
        "slug": "sample1",
        "parent": 0,
        "created_at": "2019-10-30T00:06:03Z",
        "updated_at": "2019-10-30T00:06:29Z"
    },
    {
        "id": 2,
        "name": "Sample2",
        "slug": "Sample2",
        "parent": 3,
        "created_at": "2019-10-30T00:07:20Z",
        "updated_at": "2019-10-30T00:41:37Z"
    },
    {
        "id": 3,
        "name": "Sample3",
        "slug": "Sample3",
        "parent": 0,
        "created_at": "2019-10-30T00:36:34Z",
        "updated_at": "2019-10-30T00:36:34Z"
    }
]
```

### HTTP Request
`GET api/categories`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    except |  optional  | Category id to except

<!-- END_109013899e0bc43247b0f00b67f889cf -->

<!-- START_2335abbed7f782ea7d7dd6df9c738d74 -->
## カテゴリーを保存

> Example request:

```bash
curl -X POST "http://localhost:8080/api/categories" \
    -H "Content-Type: application/json" \
    -d '{"name":"\u30a6\u30a7\u30d6","slug":"web","parent":2}'

```

```javascript
const url = new URL("http://localhost:8080/api/categories");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "\u30a6\u30a7\u30d6",
    "slug": "web",
    "parent": 2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 13,
    "name": "ウェブ",
    "slug": "web",
    "parent": "2",
    "created_at": "2019-10-17T13:28:08Z",
    "updated_at": "2019-10-17T13:28:08Z"
}
```

### HTTP Request
`POST api/categories`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Category name.
    slug | string |  required  | Category slug.
    parent | integer |  optional  | Parent ID.

<!-- END_2335abbed7f782ea7d7dd6df9c738d74 -->

<!-- START_34925c1e31e7ecc53f8f52c8b1e91d44 -->
## カテゴリーを取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/categories/1" \
    -H "Content-Type: application/json" \
    -d '{"id":13}'

```

```javascript
const url = new URL("http://localhost:8080/api/categories/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 13
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 1,
    "name": "Sample1",
    "slug": "sample1",
    "parent": 0,
    "created_at": "2019-10-30T00:06:03Z",
    "updated_at": "2019-10-30T00:06:29Z"
}
```

### HTTP Request
`GET api/categories/{category}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Category id.

<!-- END_34925c1e31e7ecc53f8f52c8b1e91d44 -->

<!-- START_549109b98c9f25ebff47fb4dc23423b6 -->
## カテゴリーを更新

> Example request:

```bash
curl -X PUT "http://localhost:8080/api/categories/1" \
    -H "Content-Type: application/json" \
    -d '{"id":13,"name":"\u30a6\u30a7\u30d6","slug":"web","parent":2}'

```

```javascript
const url = new URL("http://localhost:8080/api/categories/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 13,
    "name": "\u30a6\u30a7\u30d6",
    "slug": "web",
    "parent": 2
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 13,
    "name": "ウェブ",
    "slug": "web",
    "parent": "2",
    "created_at": "2019-10-17T13:28:08Z",
    "updated_at": "2019-10-17T13:28:08Z"
}
```

### HTTP Request
`PUT api/categories/{category}`

`PATCH api/categories/{category}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Category id.
    name | string |  required  | Category name.
    slug | string |  required  | Category slug.
    parent | integer |  optional  | Parent ID.

<!-- END_549109b98c9f25ebff47fb4dc23423b6 -->

#2. Post


<!-- START_ea8d166c68ec035668ea724e12cafa45 -->
## 記事を保存

> Example request:

```bash
curl -X POST "http://localhost:8080/api/posts" \
    -H "Content-Type: application/json" \
    -d '{"posts":{"slug":"web","title":"Web\u306e\u57fa\u672c","content":"Web\u306e\u57fa\u672c\u306fTCP\/IP\u3067\u3059\u3002","parent":12},"category_posts":{"category_id":1}}'

```

```javascript
const url = new URL("http://localhost:8080/api/posts");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "posts": {
        "slug": "web",
        "title": "Web\u306e\u57fa\u672c",
        "content": "Web\u306e\u57fa\u672c\u306fTCP\/IP\u3067\u3059\u3002",
        "parent": 12
    },
    "category_posts": {
        "category_id": 1
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 13,
        "slug": "web",
        "title": "Webの基本",
        "content": "Webの基本はTCP・IPです。",
        "parent": 12,
        "status": "private",
        "category_post": {
            "id": 13,
            "category_id": 1,
            "post_id": 13,
            "created_at": "2019-10-30T05:15:06Z",
            "updated_at": "2019-10-30T05:15:06Z"
        },
        "deleted_at": null,
        "created_at": "2019-10-17T13:28:08Z",
        "updated_at": "2019-10-17T13:28:08Z"
    }
]
```

### HTTP Request
`POST api/posts`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    posts[slug] | string |  required  | Post slug.
    posts[title] | string |  required  | Post title.
    posts[content] | string |  required  | Post content.
    posts[parent] | integer |  optional  | Post parant ID.
    category_posts[category_id] | integer |  optional  | CategoryPost ID.

<!-- END_ea8d166c68ec035668ea724e12cafa45 -->

#general


<!-- START_4cf62d5f888cef179f9e93c44d0d51ef -->
## api/sample
> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/sample" 
```

```javascript
const url = new URL("http://localhost:8080/api/sample");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "title": "thanks god"
}
```

### HTTP Request
`GET api/sample`


<!-- END_4cf62d5f888cef179f9e93c44d0d51ef -->


