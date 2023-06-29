<?php

namespace MrVaco\NovaBlog;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use MrVaco\NovaBlog\Nova\CategoryResource;

class ToolServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
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
            CategoryResource::class
        ]);
    }
}
