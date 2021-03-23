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
| 31     | 認証失敗のエラー                   |
| 32     | 権限不足のエラー                   |
| 33     | 対象が見つからない                 |
| 40     | 無効なクエリ                       |


#1. Posts


<!-- START_109013899e0bc43247b0f00b67f889cf -->
## カテゴリー一覧を取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/categories?except=beatae" 
```

```javascript
const url = new URL("http://localhost:8080/api/categories");

    let params = {
            "except": "beatae",
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
        "name": "ウェブ",
        "slug": "web",
        "parent": 0,
        "created_at": "2019-10-17T09:18:11Z",
        "updated_at": "2019-10-17T09:18:11Z"
    },
    {
        "id": 2,
        "name": "HTML",
        "slug": "html",
        "parent": 0,
        "created_at": "2019-10-17T09:20:33Z",
        "updated_at": "2019-10-17T09:20:33Z"
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
    "id": 13,
    "name": "ウェブ",
    "slug": "web",
    "parent": "2",
    "created_at": "2019-10-17T13:28:08Z",
    "updated_at": "2019-10-20T13:28:08Z"
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

<!-- START_da50450f1df5336c2a14a7a368c5fb9c -->
## 記事一覧を取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/posts?except=inventore" 
```

```javascript
const url = new URL("http://localhost:8080/api/posts");

    let params = {
            "except": "inventore",
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
        "slug": "web",
        "title": "Webの基本",
        "content": "Webの基本はTCP・IPです。",
        "parent": 12,
        "status": "private",
        "category_post": {
            "id": 1,
            "category_id": 1,
            "post_id": 1,
            "created_at": "2019-10-30T04:53:07Z",
            "updated_at": "2019-10-30T04:53:07Z"
        },
        "deleted_at": null,
        "created_at": "2019-10-30T04:53:07Z",
        "updated_at": "2019-10-30T04:53:07Z"
    },
    {
        "id": 2,
        "slug": "web2",
        "title": "Webの基本",
        "content": "Webの基本はHTTP通信です。",
        "parent": 12,
        "status": "private",
        "category_post": {
            "id": 2,
            "category_id": 1,
            "post_id": 2,
            "created_at": "2019-10-30T04:57:19Z",
            "updated_at": "2019-10-30T04:57:19Z"
        },
        "deleted_at": null,
        "created_at": "2019-10-30T04:57:19Z",
        "updated_at": "2019-10-30T04:57:19Z"
    }
]
```

### HTTP Request
`GET api/posts`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    except |  optional  | Category id to except

<!-- END_da50450f1df5336c2a14a7a368c5fb9c -->

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

<!-- START_726b7bf93b3209836a1cbcda5b3b6703 -->
## 記事を取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/posts/1" \
    -H "Content-Type: application/json" \
    -d '{"id":13}'

```

```javascript
const url = new URL("http://localhost:8080/api/posts/1");

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
```

### HTTP Request
`GET api/posts/{post}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Post id.

<!-- END_726b7bf93b3209836a1cbcda5b3b6703 -->

<!-- START_6d1dfaf5fa710725519375063e4e9db0 -->
## カテゴリーを更新

> Example request:

```bash
curl -X PUT "http://localhost:8080/api/posts/1" \
    -H "Content-Type: application/json" \
    -d '{"id":1,"posts":{"slug":"web","title":"Web\u306e\u57fa\u672c","content":"Web\u306e\u57fa\u672c\u306fTCP\/IP\u3067\u3059\u3002","parent":12},"category_posts":{"category_id":1}}'

```

```javascript
const url = new URL("http://localhost:8080/api/posts/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 1,
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
```

### HTTP Request
`PUT api/posts/{post}`

`PATCH api/posts/{post}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Post id.
    posts[slug] | string |  required  | Post slug.
    posts[title] | string |  required  | Post title.
    posts[content] | string |  required  | Post content.
    posts[parent] | integer |  optional  | Post parant ID.
    category_posts[category_id] | integer |  optional  | CategoryPost ID.

<!-- END_6d1dfaf5fa710725519375063e4e9db0 -->

<!-- START_790d23dbb8c799c36c70f7133a51e7a5 -->
## 記事を削除

> Example request:

```bash
curl -X DELETE "http://localhost:8080/api/posts/1" \
    -H "Content-Type: application/json" \
    -d '{"id":1}'

```

```javascript
const url = new URL("http://localhost:8080/api/posts/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 1
}

fetch(url, {
    method: "DELETE",
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
```

### HTTP Request
`DELETE api/posts/{post}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Post id.

<!-- END_790d23dbb8c799c36c70f7133a51e7a5 -->

<!-- START_acaa9500f220d6a67942ac923cd26e7d -->
## 記事を公開

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/posts/1/publish" \
    -H "Content-Type: application/json" \
    -d '{"id":1}'

```

```javascript
const url = new URL("http://localhost:8080/api/posts/1/publish");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 1
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
```

### HTTP Request
`GET api/posts/{post}/publish`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Post id.

<!-- END_acaa9500f220d6a67942ac923cd26e7d -->

<!-- START_b983679a3d7e0cf86939f7140d986aca -->
## 記事を非公開

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/posts/1/unpublish" \
    -H "Content-Type: application/json" \
    -d '{"id":1}'

```

```javascript
const url = new URL("http://localhost:8080/api/posts/1/unpublish");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 1
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
```

### HTTP Request
`GET api/posts/{post}/unpublish`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Post id.

<!-- END_b983679a3d7e0cf86939f7140d986aca -->

#2. Courses


<!-- START_0ec32a5c7dac7b493d908412c6b29324 -->
## コース一覧を取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/courses" 
```

```javascript
const url = new URL("http://localhost:8080/api/courses");

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
        "name": "serverside",
        "description": "サーバーサイドエンジニアとして業務で自走できるようになることがゴールです。",
        "created_at": "2020-02-28 06:48:01",
        "updated_at": "2020-02-28 06:48:01"
    }
]
```

### HTTP Request
`GET api/courses`


<!-- END_0ec32a5c7dac7b493d908412c6b29324 -->

<!-- START_40bcb093158f821689fe8255bf26f2c9 -->
## コースとレクチャー一覧を取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/courses/lectures" 
```

```javascript
const url = new URL("http://localhost:8080/api/courses/lectures");

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
        "name": "serverside",
        "description": "実務で自走できるようになることを目指します",
        "created_at": "2020-02-26T06:18:39Z",
        "updated_at": "2020-02-26T06:18:39Z",
        "parts": [
            {
                "id": 1,
                "course_id": 1,
                "order": 1,
                "name": "コースへようこそ！",
                "created_at": "2020-02-26T06:18:39Z",
                "updated_at": "2020-02-26T06:18:39Z",
                "lessons": [
                    {
                        "id": 1,
                        "part_id": 1,
                        "order": 1,
                        "name": "コースへようこそ！",
                        "created_at": "2020-02-26T06:18:39Z",
                        "updated_at": "2020-02-26T06:18:39Z",
                        "lectures": [
                            {
                                "id": 1,
                                "lesson_id": 1,
                                "order": 1,
                                "name": "コースへようこそ！",
                                "video_url": "https:\/\/player.vimeo.com\/video\/391168857",
                                "description": "コースを受講いただきありがとうございます！これからプロのエンジニアを目指して一緒にやっていきましょう！",
                                "slug": "rQI62",
                                "prev_lecture_slug": "",
                                "next_lecture_slug": "bN5sY6",
                                "public": 1,
                                "locked": 0,
                                "premium": 0,
                                "created_at": "2020-02-26T06:18:39Z",
                                "updated_at": "2020-02-26T06:18:39Z"
                            }
                        ]
                    }
                ]
            }
        ]
    }
]
```

### HTTP Request
`GET api/courses/lectures`


<!-- END_40bcb093158f821689fe8255bf26f2c9 -->

<!-- START_e5cddee10826806d96df004ae3d72b06 -->
## コースを取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/courses/1" 
```

```javascript
const url = new URL("http://localhost:8080/api/courses/1");

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
    "id": 1,
    "name": "serverside",
    "description": "サーバーサイドエンジニアとして業務で自走できるようになることがゴールです。",
    "created_at": "2020-02-28 06:48:01",
    "updated_at": "2020-02-28 06:48:01"
}
```

### HTTP Request
`GET api/courses/{name}`


<!-- END_e5cddee10826806d96df004ae3d72b06 -->

<!-- START_3e4e232fd3fc34b8490c4acea01edbcd -->
## パート一覧を取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/parts?course=sint" 
```

```javascript
const url = new URL("http://localhost:8080/api/parts");

    let params = {
            "course": "sint",
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
        "course_id": 1,
        "order": 1,
        "name": "イントロダクション",
        "description": "独学サーバーサイドのコースへようこそ！最初に、コースを受講するとできるようになることと、コースの進め方について学びます。"
    }
]
```

### HTTP Request
`GET api/parts`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    course |  optional  | Course name

<!-- END_3e4e232fd3fc34b8490c4acea01edbcd -->

<!-- START_880928cac6e549f7d27a2455c02a96ae -->
## レッスン一覧を取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/lessons?course=natus" 
```

```javascript
const url = new URL("http://localhost:8080/api/lessons");

    let params = {
            "course": "natus",
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
        "part_id": 1,
        "order": 1,
        "name": "コースへようこそ！"
    }
]
```

### HTTP Request
`GET api/lessons`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    course |  optional  | Course name

<!-- END_880928cac6e549f7d27a2455c02a96ae -->

<!-- START_4253d4039ed4be30326b5d1b32f2df9c -->
## コース一覧を取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/lectures?course=sunt" 
```

```javascript
const url = new URL("http://localhost:8080/api/lectures");

    let params = {
            "course": "sunt",
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
        "lesson_id": 1,
        "order": 1,
        "name": "コースへようこそ！",
        "slug": "rQI62"
    }
]
```

### HTTP Request
`GET api/lectures`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    course |  optional  | Course name

<!-- END_4253d4039ed4be30326b5d1b32f2df9c -->

<!-- START_5aea6b8a5b275ae465be60b5be677eae -->
## レクチャーを取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/lectures/1" \
    -H "Content-Type: application/json" \
    -d '{"slug":"bN5sY6"}'

```

```javascript
const url = new URL("http://localhost:8080/api/lectures/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "slug": "bN5sY6"
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
    "id": 2,
    "course_id": 1,
    "lesson_id": 1,
    "order": 2,
    "name": "コースのゴール",
    "video_url": "https:\/\/player.vimeo.com\/video\/391168857",
    "description": "コースを受講後にできるようになっていることを解説します。コースを完了すれば、みなさんのキャリアが変わっています！",
    "slug": "bN5sY6",
    "prev_lecture_slug": "rQI62",
    "next_lecture_slug": "ToeOO",
    "premium": 0,
    "created_at": "2019-10-17T13:28:08Z",
    "updated_at": "2019-10-17T13:28:08Z",
    "learned": true
}
```

### HTTP Request
`GET api/lectures/{slug}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    slug | string |  required  | Lecture slug.

<!-- END_5aea6b8a5b275ae465be60b5be677eae -->

#3. Users


<!-- START_8653614346cb0e3d444d164579a0a0a2 -->
## ユーザーを取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/users/1" 
```

```javascript
const url = new URL("http://localhost:8080/api/users/1");

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
    "id": 13,
    "username": "kiyodori",
    "email": "kiyodori@example.com",
    "deleted_at": "2019-10-17T13:28:08Z",
    "created_at": "2019-10-17T13:28:08Z",
    "updated_at": "2019-10-17T13:28:08Z"
}
```

### HTTP Request
`GET api/users/{user}`


<!-- END_8653614346cb0e3d444d164579a0a0a2 -->

<!-- START_48a3115be98493a3c866eb0e23347262 -->
## ユーザーを更新

> Example request:

```bash
curl -X PUT "http://localhost:8080/api/users/1" \
    -H "Content-Type: application/json" \
    -d '{"users":{"username":"kiyodori","email":"sample@example.com"}}'

```

```javascript
const url = new URL("http://localhost:8080/api/users/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "users": {
        "username": "kiyodori",
        "email": "sample@example.com"
    }
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
    "username": "kiyodori",
    "email": "kiyodori@example.com",
    "deleted_at": "2019-10-17T13:28:08Z",
    "created_at": "2019-10-17T13:28:08Z",
    "updated_at": "2019-10-17T13:28:08Z"
}
```

### HTTP Request
`PUT api/users/{user}`

`PATCH api/users/{user}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    users[username] | string |  required  | User username.
    users[email] | string |  required  | User email.

<!-- END_48a3115be98493a3c866eb0e23347262 -->

<!-- START_d2db7a9fe3abd141d5adbc367a88e969 -->
## ユーザーを削除

> Example request:

```bash
curl -X DELETE "http://localhost:8080/api/users/1" 
```

```javascript
const url = new URL("http://localhost:8080/api/users/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 13,
    "username": "kiyodori",
    "email": "kiyodori@example.com",
    "deleted_at": "2019-10-17T13:28:08Z",
    "created_at": "2019-10-17T13:28:08Z",
    "updated_at": "2019-10-17T13:28:08Z"
}
```

### HTTP Request
`DELETE api/users/{user}`


<!-- END_d2db7a9fe3abd141d5adbc367a88e969 -->

<!-- START_9a8b7bd348230c65efa299e8c5ee8330 -->
## 受講情報を保存

> Example request:

```bash
curl -X POST "http://localhost:8080/api/learning_histories" \
    -H "Content-Type: application/json" \
    -d '{"user_id":10,"lecture_id":1}'

```

```javascript
const url = new URL("http://localhost:8080/api/learning_histories");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "user_id": 10,
    "lecture_id": 1
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
    "user_id": 10,
    "lecture_id": 1,
    "created_at": "2019-10-17T13:28:08Z",
    "updated_at": "2019-10-17T13:28:08Z"
}
```

### HTTP Request
`POST api/learning_histories`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | integer |  required  | User id.
    lecture_id | integer |  required  | Lecture id.

<!-- END_9a8b7bd348230c65efa299e8c5ee8330 -->

<!-- START_a00d2732637251264272d45b473d0ab3 -->
## レクチャーIDを取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/learning_histories/1/lecture_ids" \
    -H "Content-Type: application/json" \
    -d '{"course_name":"serverside"}'

```

```javascript
const url = new URL("http://localhost:8080/api/learning_histories/1/lecture_ids");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "course_name": "serverside"
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
    "id": 13,
    "user_id": 10,
    "lecture_id": 1,
    "created_at": "2019-10-17T13:28:08Z",
    "updated_at": "2019-10-17T13:28:08Z"
}
```

### HTTP Request
`GET api/learning_histories/{course_name}/lecture_ids`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    course_name | string |  required  | Course name.

<!-- END_a00d2732637251264272d45b473d0ab3 -->

<!-- START_12e37982cc5398c7100e59625ebb5514 -->
## ユーザーを保存

> Example request:

```bash
curl -X POST "http://localhost:8080/api/users" \
    -H "Content-Type: application/json" \
    -d '{"users":{"username":"kiyodori","email":"sample@example.com"}}'

```

```javascript
const url = new URL("http://localhost:8080/api/users");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "users": {
        "username": "kiyodori",
        "email": "sample@example.com"
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
{
    "id": 13,
    "username": "kiyodori",
    "email": "kiyodori@example.com",
    "deleted_at": "2019-10-17T13:28:08Z",
    "created_at": "2019-10-17T13:28:08Z",
    "updated_at": "2019-10-17T13:28:08Z"
}
```

### HTTP Request
`POST api/users`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    users[username] | string |  required  | User username.
    users[email] | string |  required  | User email.

<!-- END_12e37982cc5398c7100e59625ebb5514 -->

<!-- START_942e4d62793db400efd4b9f9f545ea48 -->
## 受講情報を保存

> Example request:

```bash
curl -X POST "http://localhost:8080/api/taking_courses" \
    -H "Content-Type: application/json" \
    -d '{"user_id":10,"course_id":1}'

```

```javascript
const url = new URL("http://localhost:8080/api/taking_courses");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "user_id": 10,
    "course_id": 1
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
    "user_id": 10,
    "course_id": 1,
    "created_at": "2019-10-17T13:28:08Z",
    "updated_at": "2019-10-17T13:28:08Z"
}
```

### HTTP Request
`POST api/taking_courses`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | integer |  required  | User id.
    course_id | integer |  required  | Course id.

<!-- END_942e4d62793db400efd4b9f9f545ea48 -->

#4. Auth0


<!-- START_987ee5cd51f489c2c32dc75bdbf8bc6f -->
## 認証用メールを送信

> Example request:

```bash
curl -X POST "http://localhost:8080/api/auth0/send_verification_email" 
```

```javascript
const url = new URL("http://localhost:8080/api/auth0/send_verification_email");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth0/send_verification_email`


<!-- END_987ee5cd51f489c2c32dc75bdbf8bc6f -->

#5. Subscriptions


<!-- START_b63bdc84eb438e785c22339e69275df5 -->
## サブスクリプションを保存

> Example request:

```bash
curl -X POST "http://localhost:8080/api/subscriptions" \
    -H "Content-Type: application/json" \
    -d '{"session_id":"cs_test_a1WlBanMf7"}'

```

```javascript
const url = new URL("http://localhost:8080/api/subscriptions");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "session_id": "cs_test_a1WlBanMf7"
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
    "user_id": 10,
    "name": "serverside",
    "stripe_id": "sub_J8u7SyW2sqMoGH",
    "stripe_status": "paid",
    "stripe_plan": null,
    "quantity": null,
    "ends_at": null,
    "created_at": "2019-10-17T13:28:08Z",
    "updated_at": "2019-10-17T13:28:08Z"
}
```

### HTTP Request
`POST api/subscriptions`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    session_id | string |  required  | Stripe session id.

<!-- END_b63bdc84eb438e785c22339e69275df5 -->

<!-- START_54537cf79da06dce6f916ae42b2fb880 -->
## カスタマーポータルを作成

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/subscriptions/customer_portal" 
```

```javascript
const url = new URL("http://localhost:8080/api/subscriptions/customer_portal");

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
    "url": "https:\/\/billing.stripe.com\/session\/_JANkBAkl6"
}
```

### HTTP Request
`GET api/subscriptions/customer_portal`


<!-- END_54537cf79da06dce6f916ae42b2fb880 -->

<!-- START_1463b9e2d65ac7007aead02ed4bf021d -->
## サブスクリプション情報を取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/subscriptions/1?user_id=10" 
```

```javascript
const url = new URL("http://localhost:8080/api/subscriptions/1");

    let params = {
            "user_id": "10",
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
{
    "id": 13,
    "user_id": 10,
    "name": "serverside",
    "stripe_id": "sub_J8u7SyW2sqMoGH",
    "stripe_status": "paid",
    "stripe_plan": null,
    "quantity": null,
    "ends_at": null,
    "created_at": "2019-10-17T13:28:08Z",
    "updated_at": "2019-10-17T13:28:08Z"
}
```

### HTTP Request
`GET api/subscriptions/{userId}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    user_id |  optional  | int required User id.

<!-- END_1463b9e2d65ac7007aead02ed4bf021d -->

<!-- START_7f4140edeffc286fbf1c0d57bc09738b -->
## チェックアウトセッションを作成

> Example request:

```bash
curl -X POST "http://localhost:8080/api/subscriptions/create_checkout_sessions" \
    -H "Content-Type: application/json" \
    -d '{"price_id":"price_1IXhEbFtloVF6oou"}'

```

```javascript
const url = new URL("http://localhost:8080/api/subscriptions/create_checkout_sessions");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "price_id": "price_1IXhEbFtloVF6oou"
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
    "sessionId": "cs_test_a1WlBanMf7"
}
```

### HTTP Request
`POST api/subscriptions/create_checkout_sessions`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    price_id | string |  required  | Stripe Price id.

<!-- END_7f4140edeffc286fbf1c0d57bc09738b -->

#general


<!-- START_46abdb365a7dca172c3257c85dbbdbe0 -->
## レスポンス200を返す

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/health" 
```

```javascript
const url = new URL("http://localhost:8080/api/health");

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


> Example response:

```json
null
```

### HTTP Request
`GET api/health`


<!-- END_46abdb365a7dca172c3257c85dbbdbe0 -->


