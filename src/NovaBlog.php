<?php

namespace MrVaco\NovaBlog;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Tool;
use MrVaco\NovaBlog\Nova\CategoryResource;
use MrVaco\NovaBlog\Nova\PostResource;

class NovaBlog extends Tool
{
    public function boot(): void {}
    
    public function menu(Request $request): mixed
    {
        return MenuSection::make(__('Blog'), [
            MenuItem::make(PostResource::label())
                ->path('/resources/' . PostResource::uriKey()),
            
            MenuItem::make(CategoryResource::label())
                ->path('/resources/' . CategoryResource::uriKey())
        ])
            ->icon('newspaper');
    }
}
