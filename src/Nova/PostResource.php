<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Nova;

use Carbon\Carbon;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
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
        'name', 'slug', 'title', 'keywords'
    ];
    
    public function fields(NovaRequest $request): array
    {
        return $this->fieldsArray($request);
    }
    
    public function fieldsForCreate(NovaRequest $request): array
    {
        return [
            Panel::make(__('Create :resource', [
                'resource' => __('post'),
            ]),
                array_merge($this->fieldsArray($request), [
                    Hidden::make(__('Creator ID'), 'creator_id')
                        ->fillUsing(function($request, $model, $attribute, $requestAttribute)
                        {
                            $model->{$attribute} = auth()->user()->id;
                        }),
                ])
            ),
        ];
    }
    
    public function fieldsForUpdate(NovaRequest $request): array
    {
        return [
            Panel::make(__('Update :resource: :title', [
                'resource' => '',
                'title'    => $this->title()
            ]), $this->fieldsArray($request))
        ];
    }
    
    protected function fieldsArray(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),
            
            Select::make(__('Category ID'), 'category_id')
                ->options(Category::activeList()->pluck('name', 'id'))
                ->rules(['required'])
                ->hideFromIndex()
                ->hideFromDetail(),
            
            Text::make(__('Category'), 'category->name')
                ->sortable()
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            
            Text::make(__('Name'), 'name')
                ->creationRules(['required', 'unique:mrvaco_blog_posts', 'min:3', 'max:255'])
                ->updateRules(['required', 'min:3', 'max:255'])
                ->sortable(),
            
            Slug::make(__('Slug'), 'slug')
                ->from('name')
                ->creationRules(['required', 'unique:mrvaco_blog_posts', 'min:3', 'max:255'])
                ->updateRules(['required', 'min:3', 'max:255'])
                ->sortable()
                ->hideFromIndex(),
            
            Text::make(__('Title'), 'title')
                ->dependsOn(['name'],
                    function(Text $field, NovaRequest $request, FormData $formData)
                    {
                        $field->value = $formData->name;
                    }
                )
                ->creationRules(['required', 'unique:mrvaco_blog_posts', 'min:3', 'max:255'])
                ->updateRules(['required', 'min:3', 'max:255'])
                ->sortable(),
            
            Text::make(__('Keywords'), 'keywords')
                ->hideFromIndex(),
            
            Textarea::make(__('Introductory'), 'introductory')
                ->rows(2)
                ->rules(['required'])
                ->sortable(),
            
            Textarea::make(__('Content'), 'content')
                ->rows(5)
                ->rules(['required'])
                ->sortable(),
            
            Status::make(__('Status'), 'status')
                ->rules(['required'])
                ->options(StatusClass::LIST('short'))
                ->default(StatusClass::ACTIVE()->id)
                ->sortable(),
            
            DateTime::make(__('Published At'), 'published_at')
                ->nullable()
                ->step(60),
            
            Image::make(__('Image'), 'image')
                ->disk('public')
                ->path(
                    sprintf('/blog/posts/%s/', Carbon::now()->format("Y-m-d"))
                ),
            
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
        return 'blog-posts';
    }
    
    public static function label(): string
    {
        return __('Posts');
    }
    
    public static function createButtonLabel(): string
    {
        return __('Create blog post');
    }
    
    public static function updateButtonLabel(): string
    {
        return __('Update :name', ['name' => __('post')]);
    }
}
