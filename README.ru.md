![Mr.VACO Blog plugin](https://preview.dragon-code.pro/Mr.VACO/Blog%20plugin.svg?pretty-title=0&github%5Brepository%5D=MrVACO%2FNovaBlog&mode=auto)

# Установка

```
composer require mr-vaco/nova-blog
```

```
php artisan vendor:publish --tag=blog-migrations
```

> Если ранее не был установлен компонент "Галерея": [NovaGallery](https://github.com/MrVACO/NovaGallery?tab=readme-ov-file#installation)
>
> Если ранее не был установлен компонент "Менеджер статусов": [NovaStatusesManager](https://github.com/MrVACO/NovaStatusesManager?tab=readme-ov-file#installation)

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

#### Получить список категорий: ```/api/blog/categories```

```json
{
    "data": [],
    "links": {},
    "meta": {}
}
```

#### Получить категорию по слагу: ```/api/blog/categories/{slug}```

```json
{
    "data": {}
}
```

### Посты

#### Получить пост по слагу из категории: ```/api/blog/categories/{category:slug}/{post:slug}```

```json
{
    "data": {}
}
```

#### Получить посты из категории: ```/api/blog/categories/{category:slug}/posts```

```json
{
    "data": [],
    "links": {},
    "meta": {}
}
```

#### Получить "рекомендуемые" посты из категории: ```/api/blog/categories/{category:slug}/recommended```

```json
{
    "data": [],
    "links": {},
    "meta": {}
}
```

### Сортировка постов

Для маршрутов `/api/blog/categories/{category slug}/posts` и `/api/blog/categories/{category slug}/recommended`
вы можете указать столбец, по которому будет производиться сортировка записей, а также направление сортировки.

> Сортировка по столбцу: `order`
>
> Направление сортировки: `direction`

Например, сортировка по столбцу "updated_at" с направлением "asc":

`/api/blog/categories/{category slug}/posts?order=updated_at&direction=asc`

`/api/blog/categories/{category slug}/recommended?order=updated_at&direction=asc`

> По-умолчанию сортировка производится по столбцу "published_at" с направлением "desc"