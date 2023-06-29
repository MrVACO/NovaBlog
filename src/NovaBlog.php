<?php

namespace MrVaco\NovaBlog;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Tool;
use MrVaco\NovaBlog\Nova\CategoryResource;

class NovaBlog extends Tool
{
    public function boot(): void {}
    
    public function menu(Request $request): mixed
    {
        return MenuSection::make('Nova Blog', [
            MenuItem::make(CategoryResource::label())
                ->path('/resources/' . CategoryResource::uriKey())
        ])
            ->path('/resources/')
            ->icon('newspaper');
    }
}
