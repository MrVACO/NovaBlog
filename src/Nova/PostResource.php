<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Nova;

use Carbon\Carbon;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use MrVaco\NovaBlog\Models\Category;
use MrVaco\NovaBlog\Models\Post;
use MrVaco\NovaStatusesManager\Classes\StatusClass;
use MrVaco\NovaStatusesManager\Fields\Status;

class PostResource extends Resource
{
    public static $displayInNavigation = false;
    
    public static $clickAction = 'edit';
    
    public static string $model = Post::class;
    
    public static $title = 'name';
    
    public static $search = [
        'name', 'slug', 'title'
    ];
    
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),
            
            Text::make(__('Category'), 'category->name')->sortable(),
            
            Text::make(__('Name'), 'name')->sortable(),
            
            Slug::make(__('Slug'), 'slug')
                ->from('name')
                ->rules('required')
                ->sortable(),
            
            Text::make(__('Title'), 'title')
                ->dependsOn(['name'],
                    function(Text $field, NovaRequest $request, FormData $formData)
                    {
                        $field->value = $formData->name;
                    }
                ),
            
            Status::make(__('Status'), 'status')
                ->rules('required')
                ->options(StatusClass::LIST('short'))
                ->default(StatusClass::ACTIVE()->id)
                ->sortable(),
            
            Image::make(__('Image'), 'image')
                ->disk('public')
                ->indexWidth(60)
                ->detailWidth(200),
            
            Date::make('Published At')->nullable(),
        ];
    }
    
    public function fieldsForCreate(NovaRequest $request): array
    {
        return [
            Select::make(__('Category Id'), 'category_id')
                ->options(Category::activeList()->pluck('name', 'id'))
                ->rules(['required']),
            
            Text::make(__('Name'), 'name')->sortable(),
            
            Slug::make(__('Slug'), 'slug')
                ->from('name')
                ->rules('required')
                ->sortable(),
            
            Text::make(__('Title'), 'title')
                ->dependsOn(['name'],
                    function(Text $field, NovaRequest $request, FormData $formData)
                    {
                        $field->value = $formData->name;
                    }
                ),
            
            Text::make(__('Keywords'), 'keywords')->sortable(),
            
            Textarea::make(__('Introductory'), 'introductory')
                ->rows(2)
                ->sortable(),
            
            Textarea::make(__('Content'), 'content')
                ->rows(5)
                ->sortable(),
            
            Status::make(__('Status'), 'status')
                ->rules('required')
                ->options(StatusClass::LIST('short'))
                ->default(StatusClass::ACTIVE()->id)
                ->sortable(),
            
            DateTime::make('Published At')->nullable(),
            
            Image::make(__('Image'), 'image')
                ->disk('public')
                ->path(
                    sprintf('/blog/posts/%s/', Carbon::now()->format("Y-m-d"))
                ),
            
            Hidden::make('Creator ID', 'creator_id')->default(function($request)
            {
                return $request->user()->id;
            }),
            
            Hidden::make('Updator ID', 'updator_id')->default(function($request)
            {
                return $request->user()->id;
            }),
        ];
    }
    
    public function fieldsForUpdate(NovaRequest $request): array
    {
        return [
            Select::make(__('Category Id'), 'category_id')
                ->options(Category::activeList()->pluck('name', 'id'))
                ->rules(['required']),
            
            Text::make(__('Name'), 'name')->sortable(),
            
            Slug::make(__('Slug'), 'slug')
                ->from('name')
                ->rules('required')
                ->sortable(),
            
            Text::make(__('Title'), 'title')
                ->dependsOn(['name'],
                    function(Text $field, NovaRequest $request, FormData $formData)
                    {
                        $field->value = $formData->name;
                    }
                ),
            
            Text::make(__('Keywords'), 'keywords')->sortable(),
            
            Textarea::make(__('Introductory'), 'introductory')
                ->rows(2)
                ->sortable(),
            
            Textarea::make(__('Content'), 'content')
                ->rows(5)
                ->sortable(),
            
            Status::make(__('Status'), 'status')
                ->rules('required')
                ->options(StatusClass::LIST('short'))
                ->default(StatusClass::ACTIVE()->id)
                ->sortable(),
            
            DateTime::make('Published At')->nullable(),
            
            Image::make(__('Image'), 'image')
                ->disk('public')
                ->path(
                    sprintf('/blog/posts/%s', Carbon::now()->format("Y-m-d"))
                ),
            
            Hidden::make('Updator ID', 'updator_id')->default(function($request)
            {
                return $request->user()->id;
            }),
        ];
    }
    
    public static function uriKey(): string
    {
        return 'blog-posts';
    }
}
