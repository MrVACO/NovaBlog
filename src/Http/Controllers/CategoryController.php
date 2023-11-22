<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MrVaco\NovaBlog\Models\Category;
use MrVaco\NovaBlog\Resources\CategoryResource;
use MrVaco\NovaStatusesManager\Classes\StatusClass;

class CategoryController extends Controller
{
    public function list(Category $category)
    {
        $data = $category
            ->isActive()
            ->where('hidden', false)
            ->paginate(12);
        
        abort_if($data->isEmpty(), 404);
        
        return CategoryResource::collection($data);
    }
    
    /**
     * @param  Request   $request
     * @param  Category  $category
     *
     * @return JsonResponse
     */
    public function show(Request $request, Category $category)
    {
        abort_unless($category->status === StatusClass::ACTIVE()->id, 404);
        
        if ($request->has('posts'))
            $category->loadMissing('posts');
        
        return CategoryResource::make($category);
    }
}
