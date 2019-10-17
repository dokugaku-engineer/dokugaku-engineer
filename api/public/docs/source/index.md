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


<!-- START_2335abbed7f782ea7d7dd6df9c738d74 -->
## Categoryを保存

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
    slug | string |  required  | Category name.
    parent | string |  optional  | Parent ID.

<!-- END_2335abbed7f782ea7d7dd6df9c738d74 -->

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


