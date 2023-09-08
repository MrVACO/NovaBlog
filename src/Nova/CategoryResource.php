<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Nova;

use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
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
        return $this->fieldsArray();
    }
    
    public function fieldsForCreate(NovaRequest $request): array
    {
        return array_merge($this->fieldsArray(), [
            Hidden::make(__('Creator ID'), 'creator_id')
                ->fillUsing(function($request, $model, $attribute, $requestAttribute)
                {
                    $model->{$attribute} = auth()->user()->id;
                }),
        ]);
    }
    
    protected function fieldsArray(): array
    {
        return [
            ID::make()->sortable(),
            
            Text::make(__('Name'), 'name')
                ->creationRules(['required', 'unique:mrvaco_blog_categories', 'min:3', 'max:255'])
                ->updateRules(['required', 'min:3', 'max:255'])
                ->sortable()
                ->col()
                ->width(6),
            
            Slug::make(__('Slug'), 'slug')
                ->from('name')
                ->creationRules(['required', 'unique:mrvaco_blog_categories', 'min:3', 'max:255'])
                ->updateRules(['required', 'min:3', 'max:255'])
                ->sortable()
                ->col()
                ->width(6),
            
            Text::make(__('Keywords'), 'keywords')
                ->hideFromIndex()
                ->sortable(),
            
            Text::make(__('Tags'), 'tags')
                ->hideFromIndex()
                ->sortable(),
            
            Textarea::make(__('Description'), 'description')
                ->rows(2)
                ->sortable(),
            
            Status::make(__('Status'), 'status')
                ->rules('required')
                ->options(StatusClass::LIST('full'))
                ->default(StatusClass::ACTIVE()->id)
                ->sortable()
                ->col()
                ->forSecondary(),
            
            Select::make(__('Hidden category?'), 'hidden')
                ->options([
                    1 => __('Yes'),
                    0 => __('No')
                ])
                ->default(0)
                ->textAlign('center')
                ->resolveUsing(function()
                {
                    return $this->hidden ? 1 : 0;
                })
                ->displayUsing(function()
                {
                    return $this->hidden ? __('Yes') : __('No');
                })
                ->col()
                ->forSecondary(),
            
            Image::make(__('Image'), 'image')
                ->disk('public')
                ->path('/blog/categories')
                ->indexWidth(60)
                ->detailWidth(200)
                ->col()
                ->forSecondary(),
            
            Number::make(__('Posts count'), function()
            {
                return $this->posts()->count();
            })
                ->textAlign('center')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->nullable(),
            
            Number::make(__('Clicks'), 'statistic->clicks')
                ->textAlign('center')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->nullable(),
            
            Number::make(__('Views'), 'statistic->views')
                ->textAlign('center')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->nullable(),
            
            Hidden::make(__('Updator ID'), 'updator_id')
                ->fillUsing(function($request, $model, $attribute, $requestAttribute)
                {
                    $model->{$attribute} = auth()->user()->id;
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
