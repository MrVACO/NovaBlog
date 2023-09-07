# Установка

```
composer require mr-vaco/nova-blog
```

```
php artisan vendor:publish --tag=blog__migrations

php artisan migrate

php artisan db:seed --class=\\MrVaco\\NovaBlog\\Database\\Seeders\\BlogCategorySeeder
```
