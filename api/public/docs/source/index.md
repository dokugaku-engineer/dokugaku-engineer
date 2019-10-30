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
curl -X GET -G "http://localhost:8080/api/categories" 
```

```javascript
const url = new URL("http://localhost:8080/api/categories");

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
    },
    {
        "id": 3,
        "name": "CSS",
        "slug": "css",
        "parent": 0,
        "created_at": "2019-10-17T09:27:21Z",
        "updated_at": "2019-10-17T09:27:21Z"
    },
    {
        "id": 4,
        "name": "Docker",
        "slug": "docker",
        "parent": 0,
        "created_at": "2019-10-17T09:28:27Z",
        "updated_at": "2019-10-17T09:28:27Z"
    },
    {
        "id": 5,
        "name": "Nuxt",
        "slug": "nuxt",
        "parent": 0,
        "created_at": "2019-10-17T09:30:20Z",
        "updated_at": "2019-10-17T09:30:20Z"
    },
    {
        "id": 6,
        "name": "JS",
        "slug": "js",
        "parent": 0,
        "created_at": "2019-10-17T09:32:18Z",
        "updated_at": "2019-10-17T09:32:18Z"
    },
    {
        "id": 7,
        "name": "type",
        "slug": "type",
        "parent": 0,
        "created_at": "2019-10-17T09:32:51Z",
        "updated_at": "2019-10-17T09:32:51Z"
    },
    {
        "id": 8,
        "name": "Ruby",
        "slug": "ruby",
        "parent": 0,
        "created_at": "2019-10-17T11:04:28Z",
        "updated_at": "2019-10-17T11:04:28Z"
    },
    {
        "id": 9,
        "name": "hoge",
        "slug": "hoge",
        "parent": 0,
        "created_at": "2019-10-17T11:12:19Z",
        "updated_at": "2019-10-17T11:12:19Z"
    },
    {
        "id": 10,
        "name": "web",
        "slug": "null",
        "parent": 0,
        "created_at": "2019-10-17T13:02:07Z",
        "updated_at": "2019-10-17T13:02:07Z"
    },
    {
        "id": 13,
        "name": "AWS",
        "slug": "aws",
        "parent": 2,
        "created_at": "2019-10-17T13:28:08Z",
        "updated_at": "2019-10-17T13:28:08Z"
    },
    {
        "id": 14,
        "name": "アンパンマン",
        "slug": "anpanman",
        "parent": 0,
        "created_at": "2019-10-19T20:17:41Z",
        "updated_at": "2019-10-19T20:17:41Z"
    },
    {
        "id": 15,
        "name": "Sample",
        "slug": "sample",
        "parent": 0,
        "created_at": "2019-10-19T20:39:19Z",
        "updated_at": "2019-10-19T20:39:19Z"
    },
    {
        "id": 16,
        "name": "Sample1",
        "slug": "sample1",
        "parent": 0,
        "created_at": "2019-10-19T20:40:22Z",
        "updated_at": "2019-10-19T20:40:22Z"
    },
    {
        "id": 17,
        "name": "Sample2",
        "slug": "sample2",
        "parent": 0,
        "created_at": "2019-10-19T20:55:26Z",
        "updated_at": "2019-10-19T20:55:26Z"
    },
    {
        "id": 18,
        "name": "Sample3",
        "slug": "sample3",
        "parent": 0,
        "created_at": "2019-10-19T20:56:12Z",
        "updated_at": "2019-10-19T20:56:12Z"
    },
    {
        "id": 19,
        "name": "Sample4",
        "slug": "sample4",
        "parent": 0,
        "created_at": "2019-10-19T20:56:51Z",
        "updated_at": "2019-10-19T20:56:51Z"
    },
    {
        "id": 20,
        "name": "Sample5",
        "slug": "sample5",
        "parent": 0,
        "created_at": "2019-10-19T20:58:17Z",
        "updated_at": "2019-10-19T20:58:17Z"
    },
    {
        "id": 21,
        "name": "Sample6",
        "slug": "sample6",
        "parent": 0,
        "created_at": "2019-10-20T19:58:39Z",
        "updated_at": "2019-10-20T19:58:39Z"
    },
    {
        "id": 22,
        "name": "Sample7",
        "slug": "sample7",
        "parent": 0,
        "created_at": "2019-10-20T19:59:22Z",
        "updated_at": "2019-10-20T19:59:22Z"
    },
    {
        "id": 23,
        "name": "Sample8",
        "slug": "sample8",
        "parent": 0,
        "created_at": "2019-10-25T20:30:09Z",
        "updated_at": "2019-10-25T20:30:09Z"
    },
    {
        "id": 24,
        "name": "Sample9",
        "slug": "sample9",
        "parent": 0,
        "created_at": "2019-10-25T20:32:22Z",
        "updated_at": "2019-10-25T20:32:22Z"
    },
    {
        "id": 25,
        "name": "Sample10",
        "slug": "sample10",
        "parent": 0,
        "created_at": "2019-10-25T20:45:15Z",
        "updated_at": "2019-10-25T20:45:15Z"
    },
    {
        "id": 26,
        "name": "Sample11",
        "slug": "sample11",
        "parent": 0,
        "created_at": "2019-10-25T21:32:57Z",
        "updated_at": "2019-10-25T21:32:57Z"
    },
    {
        "id": 27,
        "name": "Sample12",
        "slug": "sample12",
        "parent": 0,
        "created_at": "2019-10-25T21:35:14Z",
        "updated_at": "2019-10-25T21:35:14Z"
    },
    {
        "id": 28,
        "name": "Sample13",
        "slug": "sample13",
        "parent": 0,
        "created_at": "2019-10-25T21:36:31Z",
        "updated_at": "2019-10-25T21:36:31Z"
    },
    {
        "id": 29,
        "name": "h1",
        "slug": "h1",
        "parent": 0,
        "created_at": "2019-10-25T21:37:55Z",
        "updated_at": "2019-10-25T21:37:55Z"
    },
    {
        "id": 30,
        "name": "h2",
        "slug": "h2",
        "parent": 0,
        "created_at": "2019-10-25T21:38:51Z",
        "updated_at": "2019-10-25T21:38:51Z"
    },
    {
        "id": 31,
        "name": "Sample14",
        "slug": "sample14",
        "parent": 0,
        "created_at": "2019-10-25T21:57:42Z",
        "updated_at": "2019-10-25T21:57:42Z"
    },
    {
        "id": 32,
        "name": "Sample15",
        "slug": "sample15",
        "parent": 0,
        "created_at": "2019-10-25T22:21:31Z",
        "updated_at": "2019-10-25T22:21:31Z"
    },
    {
        "id": 33,
        "name": "Sample16",
        "slug": "sample16",
        "parent": 0,
        "created_at": "2019-10-25T22:25:40Z",
        "updated_at": "2019-10-25T22:25:40Z"
    },
    {
        "id": 34,
        "name": "Sample17",
        "slug": "sample17",
        "parent": 0,
        "created_at": "2019-10-25T22:27:45Z",
        "updated_at": "2019-10-25T22:27:45Z"
    },
    {
        "id": 35,
        "name": "sensuikan1973",
        "slug": "100",
        "parent": 0,
        "created_at": "2019-10-25T22:30:16Z",
        "updated_at": "2019-10-25T22:30:16Z"
    },
    {
        "id": 36,
        "name": "sensuikan1",
        "slug": "1",
        "parent": 0,
        "created_at": "2019-10-25T22:32:30Z",
        "updated_at": "2019-10-25T22:32:30Z"
    },
    {
        "id": 37,
        "name": "Sample20",
        "slug": "Sample20",
        "parent": 0,
        "created_at": "2019-10-26T22:05:14Z",
        "updated_at": "2019-10-26T22:05:14Z"
    },
    {
        "id": 38,
        "name": "Sample21",
        "slug": "Sample21",
        "parent": 0,
        "created_at": "2019-10-28T04:02:09Z",
        "updated_at": "2019-10-28T04:02:09Z"
    },
    {
        "id": 39,
        "name": "Sample22",
        "slug": "Sample22",
        "parent": 0,
        "created_at": "2019-10-28T05:27:29Z",
        "updated_at": "2019-10-28T05:27:29Z"
    },
    {
        "id": 40,
        "name": "Sample23",
        "slug": "Sample23",
        "parent": 0,
        "created_at": "2019-10-28T08:04:50Z",
        "updated_at": "2019-10-28T08:04:50Z"
    },
    {
        "id": 41,
        "name": "Sample24",
        "slug": "Sample24",
        "parent": 0,
        "created_at": "2019-10-28T19:57:47Z",
        "updated_at": "2019-10-28T19:57:47Z"
    },
    {
        "id": 42,
        "name": "Sample25",
        "slug": "Sample25",
        "parent": 0,
        "created_at": "2019-10-28T20:16:51Z",
        "updated_at": "2019-10-28T20:16:51Z"
    },
    {
        "id": 43,
        "name": "Sample26",
        "slug": "Sample26",
        "parent": 0,
        "created_at": "2019-10-29T01:30:19Z",
        "updated_at": "2019-10-29T01:30:19Z"
    },
    {
        "id": 44,
        "name": "Sample27",
        "slug": "Sample27",
        "parent": 0,
        "created_at": "2019-10-29T01:30:55Z",
        "updated_at": "2019-10-29T01:30:55Z"
    },
    {
        "id": 45,
        "name": "Sample28",
        "slug": "Sample28",
        "parent": 0,
        "created_at": "2019-10-29T01:31:38Z",
        "updated_at": "2019-10-29T01:31:38Z"
    },
    {
        "id": 46,
        "name": "Sample29",
        "slug": "Sample29",
        "parent": 0,
        "created_at": "2019-10-29T01:34:05Z",
        "updated_at": "2019-10-29T01:34:05Z"
    },
    {
        "id": 47,
        "name": "Sample30",
        "slug": "Sample30",
        "parent": 0,
        "created_at": "2019-10-29T01:34:33Z",
        "updated_at": "2019-10-29T01:34:33Z"
    },
    {
        "id": 48,
        "name": "Sample31",
        "slug": "Sample31",
        "parent": 0,
        "created_at": "2019-10-29T01:39:53Z",
        "updated_at": "2019-10-29T01:39:53Z"
    },
    {
        "id": 49,
        "name": "Sample32",
        "slug": "Sample32",
        "parent": 0,
        "created_at": "2019-10-29T01:40:58Z",
        "updated_at": "2019-10-29T01:40:58Z"
    },
    {
        "id": 50,
        "name": "Sample33",
        "slug": "Sample33",
        "parent": 0,
        "created_at": "2019-10-29T01:52:45Z",
        "updated_at": "2019-10-29T01:52:45Z"
    },
    {
        "id": 51,
        "name": "Sample34",
        "slug": "Sample34",
        "parent": 0,
        "created_at": "2019-10-29T02:57:16Z",
        "updated_at": "2019-10-29T02:57:16Z"
    },
    {
        "id": 52,
        "name": "Sample35",
        "slug": "Sample35",
        "parent": 0,
        "created_at": "2019-10-29T03:18:42Z",
        "updated_at": "2019-10-29T03:18:42Z"
    }
]
```

### HTTP Request
`GET api/categories`


<!-- END_109013899e0bc43247b0f00b67f889cf -->

<!-- START_2335abbed7f782ea7d7dd6df9c738d74 -->
## カテゴリーを保存

> Example request:

```bash
curl -X POST "http://localhost:8080/api/categories" \
    -H "Content-Type: application/json" \
    -d '{"name":"\u30a6\u30a7\u30d6","slug":"web","parent":"2"}'

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
    "parent": "2"
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
    parent | string |  optional  | Parent ID.

<!-- END_2335abbed7f782ea7d7dd6df9c738d74 -->

<!-- START_bde66498000776d89def876462bcdf29 -->
## カテゴリーを取得

> Example request:

```bash
curl -X GET -G "http://localhost:8080/api/categories/1/edit" \
    -H "Content-Type: application/json" \
    -d '{"id":13}'

```

```javascript
const url = new URL("http://localhost:8080/api/categories/1/edit");

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
    "name": "ウェブ",
    "slug": "web",
    "parent": 0,
    "created_at": "2019-10-17T09:18:11Z",
    "updated_at": "2019-10-17T09:18:11Z"
}
```

### HTTP Request
`GET api/categories/{category}/edit`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Category id.

<!-- END_bde66498000776d89def876462bcdf29 -->

<!-- START_549109b98c9f25ebff47fb4dc23423b6 -->
## カテゴリーを更新

> Example request:

```bash
curl -X PUT "http://localhost:8080/api/categories/1" \
    -H "Content-Type: application/json" \
    -d '{"id":13,"name":"\u30a6\u30a7\u30d6","slug":"web","parent":"2"}'

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
    "parent": "2"
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
    parent | string |  optional  | Parent ID.

<!-- END_549109b98c9f25ebff47fb4dc23423b6 -->

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


