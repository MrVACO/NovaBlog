![Mr.VACO Blog plugin](https://preview.dragon-code.pro/Mr.VACO/Blog%20plugin.svg?pretty-title=0&github%5Brepository%5D=MrVACO%2FNovaBlog&mode=auto)

# Установка

```
composer require mr-vaco/nova-blog
```

```
php artisan vendor:publish --tag=blog-migrations
```

```
php artisan migrate
```

```
php artisan db:seed --class=\\MrVaco\\NovaBlog\\Database\\Seeders\\BlogCategorySeeder
```

Готово! Иди в админку и довольствуйся результатом! :)

## API

> При всех запросах выводятся ТОЛЬКО активные записи

### Категории

#### Список категорий: ```/api/blog/category/list```

```json
{
    "data": [
        {
            "name": "News",
            "slug": "news",
            "keywords": null,
            "tags": null,
            "description": null,
            "image": null,
            "creator": "Admin",
            "updator": "Admin",
            "created_at": "2023-11-20T16:05:31.000000Z"
        },
        {
            "name": "Articles",
            "slug": "articles",
            "keywords": null,
            "tags": null,
            "description": null,
            "image": null,
            "creator": "Admin",
            "updator": "Admin",
            "created_at": "2023-11-20T16:05:31.000000Z"
        }
    ]
}
```

#### Получить конкретную категорию: ```/api/blog/category/{slug}```

```json
{
    "data": {
        "name": "News",
        "slug": "news",
        "keywords": null,
        "tags": null,
        "description": null,
        "image": null,
        "creator": "Admin",
        "updator": "Admin",
        "created_at": "2023-11-20T16:05:31.000000Z"
    }
}
```

#### Получить конкретную категорию с постами: ```/api/blog/category/{slug}?posts```

```json
{
    "data": {
        "name": "News",
        "slug": "news",
        "keywords": null,
        "tags": null,
        "description": null,
        "image": null,
        "creator": "Admin",
        "updator": "Admin",
        "created_at": "2023-11-20T16:05:31.000000Z",
        "posts": [
            {
                "title": "This first news",
                "slug": "this-first-news",
                "keywords": null,
                "tags": null,
                "introductory": "Lorem ipsum",
                "content": "<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>",
                "image": "/galleries/2023-11-23/image.jpg",
                "creator": "Admin",
                "updator": "Admin",
                "published_at": "2023-11-21T16:11:32.000000Z",
                "recommended": true,
                "gallery": {
                    "name": "First gallery",
                    "description": null,
                    "images": [
                        "/galleries/2023-11-23/image.jpg"
                    ],
                    "year": 2023,
                    "created_at": "2023-11-23T16:04:48.000000Z"
                }
            }
        ]
    }
}
```

### Посты

#### Список ВСЕХ постов с пометкой "рекомендовано": ```/api/blog/post/recommended```

```json
{
    "data": [
        {
            "title": "This first news",
            "slug": "this-first-news",
            "keywords": null,
            "tags": null,
            "introductory": "Lorem ipsum",
            "content": "<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>",
            "image": "/galleries/2023-11-23/image.jpg",
            "creator": "Admin",
            "updator": "Admin",
            "published_at": "2023-11-21T16:11:32.000000Z",
            "recommended": true,
            "gallery": {
                "name": "First gallery",
                "description": null,
                "images": [
                    "/galleries/2023-11-23/image.jpg"
                ],
                "year": 2023,
                "created_at": "2023-11-23T16:04:48.000000Z"
            }
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/blog/post/recommended?page=1",
        "last": "http://127.0.0.1:8000/api/blog/post/recommended?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/blog/post/recommended?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/blog/post/recommended",
        "per_page": 12,
        "to": 2,
        "total": 999
    }
}
```

#### Получить пост: ```/api/blog/post/{category slug}/{post slug}```

```json
{
    "data": {
        "title": "This first news",
        "slug": "this-first-news",
        "keywords": null,
        "tags": null,
        "introductory": "Lorem ipsum",
        "content": "<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>",
        "image": "/galleries/2023-11-23/image.jpg",
        "creator": "Admin",
        "updator": "Admin",
        "published_at": "2023-11-21T16:11:32.000000Z",
        "recommended": true,
        "gallery": {
            "name": "First gallery",
            "description": null,
            "images": [
                "/galleries/2023-11-23/image.jpg"
            ],
            "year": 2023,
            "created_at": "2023-11-23T16:04:48.000000Z"
        },
        "category": {
            "name": "News",
            "slug": "news",
            "keywords": null,
            "tags": null,
            "description": null,
            "image": null,
            "creator": "Admin",
            "updator": "Admin",
            "created_at": "2023-11-20T16:05:31.000000Z"
        }
    }
}
```