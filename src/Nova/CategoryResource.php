<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use MrVaco\NovaBlog\Models\Category;

class CategoryResource extends Resource
{
    public static $displayInNavigation = false;
    
    public static $clickAction = 'edit';
    
    public static string $model = Category::class;
    
    public static $title = 'name';
    
    public static $search = [
        'name', 'slug'
    ];
    
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make(),
            
            Text::make(__('Name'), 'name'),
            
            Slug::make(__('Slug'), 'slug')
                ->from('name')
                ->rules('required'),
            
            Text::make(__('Description'), 'description'),
        ];
    }
}
