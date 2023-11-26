![Mr.VACO Blog plugin](https://preview.dragon-code.pro/Mr.VACO/Blog%20plugin.svg?pretty-title=0&github%5Brepository%5D=MrVACO%2FNovaBlog&mode=auto)

> [RU README](./README.ru.md)

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
    "data": [],
    "links": {},
    "meta": {}
}
```

#### Get a category by slug: ```/api/blog/categories/{slug}```

```json
{
    "data": {}
}
```

### Posts

#### Get post by slug from a category: ```/api/blog/categories/{category:slug}/{post:slug}```

```json
{
    "data": {}
}
```

#### Get posts from a category: ```/api/blog/categories/{category:slug}/posts```

```json
{
    "data": [],
    "links": {},
    "meta": {}
}
```

#### Get "recommended" posts from a category: ```/api/blog/categories/{category:slug}/recommended```

```json
{
    "data": [],
    "links": {},
    "meta": {}
}
```

### Post sorting

For routes `/api/blog/categories/{category slug}/posts` and `/api/blog/categories/{category slug}/recommended`
you can specify the column by which records will be sorted, as well as the sorting direction.

> Sort by column: `order`
>
> Sorting direction: `direction`

For example, sorting by column "updated_at" with direction "asc":

`/api/blog/categories/{category slug}/posts?order=updated_at&direction=asc`

`/api/blog/categories/{category slug}/recommended?order=updated_at&direction=asc`

> By default, sorting is performed by the column "published_at" with the direction "desc"