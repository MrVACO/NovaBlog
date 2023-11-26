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
    public function show(Category $category, Post $post)
    {
        $active = StatusClass::ACTIVE()->id;
        
        abort_unless($category->status === $active && $post->status === $active, 404);
        
        return PostResource::make($post);
    }
    
    public function posts(Post $post, Category $category)
    {
        abort_unless($category->status === StatusClass::ACTIVE()->id, 404);
        
        $data = $post
            ->isActive()
            ->inCategory($category->id)
            ->orderByDesc('published_at')
            ->paginate(12);
        
        return PostResource::collection($data);
    }
    
    public function recommended(Category $category, Post $post)
    {
        abort_unless($category->status === StatusClass::ACTIVE()->id, 404);
        
        $data = $post
            ->isActive()
            ->isRecommended()
            ->inCategory($category->id)
            ->orderByDesc('published_at')
            ->paginate(12);
        
        return PostResource::collection($data);
    }
}
