<?php

namespace MrVaco\NovaBlog;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
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
        
        $this->forPublish();
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
    
    protected function forPublish()
    {
        if (!$this->app->runningInConsole())
        {
            return;
        }
        
        $this->publishes([
            __DIR__ . '/Database/migrations/create_mrvaco_blog_categories_table.stub' => $this->getMigrationFileName('create_mrvaco_blog_categories_table.php'),
            __DIR__ . '/Database/migrations/create_mrvaco_blog_posts_table.stub'      => $this->getMigrationFileName('create_mrvaco_blog_posts_table.php'),
        ], 'blog-migrations');
    }
    
    /**
     * Returns existing migration file if found, else uses the current timestamp.
     */
    protected function getMigrationFileName(string $migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');
        
        $filesystem = $this->app->make(Filesystem::class);
        
        return Collection::make([database_path('migrations/')])
            ->flatMap(fn($path) => $filesystem->glob($path . '*_' . $migrationFileName))
            ->push(database_path("/migrations/{$timestamp}_{$migrationFileName}"))
            ->first();
    }
}
