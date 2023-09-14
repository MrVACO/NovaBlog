<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use MrVaco\NovaBlog\Models\Category;
use MrVaco\NovaBlog\Resources\CategoryResource;
use MrVaco\NovaStatusesManager\Classes\StatusClass;

class CategoryController extends Controller
{
    public function list(Category $category)
    {
        $data = $category
            ->where('status', StatusClass::ACTIVE()->id)
            ->where('hidden', false)
            ->get();
        
        abort_if($data->isEmpty(), 404);
        
        return CategoryResource::collection($data);
    }
    
    /**
     * @param  Category  $category
     *
     * @return JsonResponse
     */
    public function show(Category $category)
    {
        abort_unless($category->status === StatusClass::ACTIVE()->id, 404);
        
        return CategoryResource::make($category);
    }
}
