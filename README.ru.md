# Установка

```
composer require mr-vaco/nova-blog
```

```
php artisan migrate --path=vendor/mr-vaco/nova-blog/src/database/migrations

php artisan db:seed --class=\\MrVaco\\NovaBlog\\Database\\Seeders\\BlogCategorySeeder
```
