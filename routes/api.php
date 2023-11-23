<?php

declare(strict_types = 1);

use MrVaco\NovaBlog\Http\Controllers\CategoryController;
use MrVaco\NovaBlog\Http\Controllers\PostController;

app('router')
    ->name('categories.')
    ->prefix('categories')
    ->controller(CategoryController::class)
    ->group(static function()
    {
        app('router')->get('', 'list')->name('index');
        app('router')->get('{category:slug}', 'show')->name('show');
        
        app('router')
            ->name('posts.')
            ->prefix('{category:slug}')
            ->controller(PostController::class)
            ->group(static function()
            {
                app('router')->get('posts', 'posts')->name('index');
                app('router')->get('recommended', 'recommended')->name('recommended');
                app('router')->get('{post:slug}', 'show')->name('show')->scopeBindings();
            });
    });
