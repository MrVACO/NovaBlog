![Mr.VACO Blog plugin](https://preview.dragon-code.pro/Mr.VACO/Blog%20plugin.svg?pretty-title=0&github%5Brepository%5D=MrVACO%2FNovaBlog&mode=auto)

# Installation

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

Ready! Go to the admin panel and be satisfied with the result! :)

## API

> All requests return ONLY active records

### Categories

#### List of categories: ```/api/blog/categories```

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
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/blog/categories?page=1",
        "last": "http://127.0.0.1:8000/api/blog/categories?page=1",
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
                "url": "http://127.0.0.1:8000/api/blog/categories?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/blog/categories",
        "per_page": 12,
        "to": 2,
        "total": 2
    }
}
```

#### Get a category by slug: ```/api/blog/categories/{slug}```

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

### Posts

#### Get post by slug from a category: ```/api/blog/categories/{category:slug}/{post:slug}```

```json
{
    "data": {
        "title": "First news",
        "slug": "first-news",
        "keywords": null,
        "tags": null,
        "introductory": "Introduction text",
        "content": "<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>",
        "image": "/galleries/{format 'Y-m-d'}/image_01.jpg",
        "creator": "Admin",
        "updator": "Admin",
        "published_at": "2023-11-21T16:11:32.000000Z",
        "recommended": true,
        "gallery": {
            "name": "Gallery 1",
            "description": null,
            "images": [
                "/galleries/{format 'Y-m-d'}/image_01.jpg",
                "/galleries/{format 'Y-m-d'}/image_02.jpg"
            ],
            "year": 2023,
            "created_at": "2023-11-20T16:04:48.000000Z"
        }
    }
}
```

#### Get posts from a category: ```/api/blog/categories/{category:slug}/posts```

```json
{
    "data": [
        {
            "title": "First news",
            "slug": "first-news",
            "keywords": null,
            "tags": null,
            "introductory": "Introduction text",
            "content": "<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>",
            "image": "/galleries/{format 'Y-m-d'}/image_01.jpg",
            "creator": "Admin",
            "updator": "Admin",
            "published_at": "2023-11-21T16:11:32.000000Z",
            "recommended": true,
            "gallery": {
                "name": "Gallery 1",
                "description": null,
                "images": [
                    "/galleries/{format 'Y-m-d'}/image_01.jpg",
                    "/galleries/{format 'Y-m-d'}/image_02.jpg"
                ],
                "year": 2023,
                "created_at": "2023-11-20T16:04:48.000000Z"
            }
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/blog/categories/news/posts?page=1",
        "last": "http://127.0.0.1:8000/api/blog/categories/news/posts?page=1",
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
                "url": "http://127.0.0.1:8000/api/blog/categories/news/posts?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/blog/categories/news/posts",
        "per_page": 12,
        "to": 1,
        "total": 1
    }
}
```

#### Get "recommended" posts from a category: ```/api/blog/categories/{category:slug}/recommended```

```json
{
    "data": [
        {
            "title": "Third news",
            "slug": "third-news",
            "keywords": null,
            "tags": null,
            "introductory": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "content": "<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>",
            "image": null,
            "creator": "Admin",
            "updator": "Admin",
            "published_at": "2023-11-21T16:20:09.000000Z",
            "recommended": true,
            "gallery": null
        },
        {
            "title": "First news",
            "slug": "first-news",
            "keywords": null,
            "tags": null,
            "introductory": "Introduction text",
            "content": "<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>",
            "image": "/galleries/{format 'Y-m-d'}/image_01.jpg",
            "creator": "Admin",
            "updator": "Admin",
            "published_at": "2023-11-21T16:11:32.000000Z",
            "recommended": true,
            "gallery": {
                "name": "Gallery 1",
                "description": null,
                "images": [
                    "/galleries/{format 'Y-m-d'}/image_01.jpg",
                    "/galleries/{format 'Y-m-d'}/image_02.jpg"
                ],
                "year": 2023,
                "created_at": "2023-11-20T16:04:48.000000Z"
            }
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/blog/categories/news/recommended?page=1",
        "last": "http://127.0.0.1:8000/api/blog/categories/news/recommended?page=1",
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
                "url": "http://127.0.0.1:8000/api/blog/categories/news/recommended?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/blog/categories/news/recommended",
        "per_page": 12,
        "to": 2,
        "total": 2
    }
}
```