<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Nova;

use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use MrVaco\NovaBlog\Models\Category;
use MrVaco\NovaStatusesManager\Classes\StatusClass;
use MrVaco\NovaStatusesManager\Fields\Status;

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
            ID::make()->sortable(),
            
            Text::make(__('Name'), 'name')
                ->rules(['required'])
                ->sortable(),
            
            Slug::make(__('Slug'), 'slug')
                ->from('name')
                ->rules('required')
                ->sortable(),
            
            Text::make(__('Keywords'), 'keywords')->sortable(),
            
            Textarea::make(__('Description'), 'description')
                ->rows(2)
                ->sortable(),
            
            Status::make(__('Status'), 'status')
                ->rules('required')
                ->options(StatusClass::LIST('full'))
                ->default(StatusClass::ACTIVE()->id)
                ->sortable(),
            
            Image::make(__('Image'), 'image')
                ->disk('public')
                ->path('/blog/categories')
                ->indexWidth(60)
                ->detailWidth(200),
            
            Hidden::make(__('Creator ID'), 'creator_id')->default(function($request)
            {
                return $request->user()->id;
            }),
            
            Hidden::make(__('Updator ID'), 'updator_id')->default(function($request)
            {
                return $request->user()->id;
            }),
        ];
    }
    
    public static function uriKey(): string
    {
        return 'blog-categories';
    }
    
    public static function label(): string
    {
        return __('Blog categories');
    }
    
    public static function createButtonLabel(): string
    {
        return __('Create blog category');
    }
    
    public static function updateButtonLabel(): string
    {
        return __('Update :name', ['name' => __('category')]);
    }
}
