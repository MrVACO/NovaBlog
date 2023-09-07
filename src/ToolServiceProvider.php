<?php

namespace MrVaco\NovaBlog;

use Illuminate\Support\ServiceProvider;
use Lang;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use MrVaco\NovaBlog\Models\Category;
use MrVaco\NovaBlog\Models\Post;
use MrVaco\NovaBlog\Nova\CategoryResource;
use MrVaco\NovaBlog\Nova\PostResource;
use MrVaco\NovaBlog\Observer\CategoryObserver;
use MrVaco\NovaBlog\Observer\PostObserver;

class ToolServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->booted(function()
        {
            Lang::addJsonPath(__DIR__ . '/../lang');
            
            $this->routes();
        });
        
        Nova::serving(function(ServingNova $event)
        {
            Nova::tools([
                new NovaBlog
            ]);
            
            Category::observe(CategoryObserver::class);
            Post::observe(PostObserver::class);
        });
        
        $this->publishes([
            __DIR__ . '/Database/migrations' => base_path('database/migrations'),
        ], 'blog__migrations');
    }
    
    public function register(): void
    {
        Nova::resources([
            CategoryResource::class,
            PostResource::class
        ]);
    }
    
    protected function routes(): void
    {
        if ($this->app->routesAreCached())
        {
            return;
        }
        
        app('router')
            ->middleware('api')
            ->prefix('api/blog')
            ->group(__DIR__ . '/../routes/api.php');
    }
}
