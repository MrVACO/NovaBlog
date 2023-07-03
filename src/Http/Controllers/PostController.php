<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Http\Controllers;

use App\Http\Controllers\Controller;
use MrVaco\NovaBlog\Models\Post;
use MrVaco\NovaBlog\Resources\PostResource;
use MrVaco\NovaStatusesManager\Classes\StatusClass;

class PostController extends Controller
{
    public function show(Post $post, string $category, string $slug)
    {
        $data = $post
            ->where('slug', $slug)
            ->where('status', StatusClass::ACTIVE()->id)
            ->with('category')
            ->firstOrFail();
        
        abort_if($data->category->slug !== $category, 404);
        
        return PostResource::make($data);
    }
}
