<?php

declare(strict_types = 1);

use MrVaco\NovaBlog\Http\Controllers\CategoryController;
use MrVaco\NovaBlog\Http\Controllers\PostController;

app('router')
    ->controller(CategoryController::class)
    ->prefix('category')
    ->group(function()
    {
        app('router')->get('list', 'list');
        app('router')->get('{slug}', 'show');
    });

app('router')
    ->controller(PostController::class)
    ->prefix('post')
    ->group(function()
    {
        app('router')->get('{category}/{slug}', 'show');
    });