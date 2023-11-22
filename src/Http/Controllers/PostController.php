<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Http\Controllers;

use App\Http\Controllers\Controller;
use MrVaco\NovaBlog\Models\Category;
use MrVaco\NovaBlog\Models\Post;
use MrVaco\NovaBlog\Resources\PostResource;
use MrVaco\NovaStatusesManager\Classes\StatusClass;

class PostController extends Controller
{
    public function show(Post $post, string $category, string $slug)
    {
        $active = StatusClass::ACTIVE()->id;
        
        $data = $post
            ->isActive()
            ->where('slug', $slug)
            ->with('category')
            ->firstOrFail();
        
        abort_unless($data->category->slug === $category && $data->category->status === $active, 404);
        
        return PostResource::make($data);
    }
    
    public function recommended(Post $post)
    {
        $data = $post::query()
            ->isActive()
            ->isRecommended()
            ->paginate(12);
        
        return PostResource::collection($data);
    }
    
    public function recommendedPostsFromCategory(Category $category, Post $post)
    {
        abort_unless($category->status === StatusClass::ACTIVE()->id, 404);
        
        $data = $post::query()
            ->isActive()
            ->isRecommended()
            ->inCategory($category->id)
            ->paginate(12);
        
        return PostResource::collection($data);
    }
}
