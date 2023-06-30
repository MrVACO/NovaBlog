<?php

namespace MrVaco\NovaBlog;

use Illuminate\Support\ServiceProvider;
use Lang;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use MrVaco\NovaBlog\Nova\CategoryResource;
use MrVaco\NovaBlog\Nova\PostResource;

class ToolServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->booted(function()
        {
            Lang::addJsonPath(__DIR__ . '/../lang');
        });
        
        Nova::serving(function(ServingNova $event)
        {
            Nova::tools([
                new NovaBlog
            ]);
        });
    }
    
    public function register(): void
    {
        Nova::resources([
            CategoryResource::class,
            PostResource::class
        ]);
    }
}
