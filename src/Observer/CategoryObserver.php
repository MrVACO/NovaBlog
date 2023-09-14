<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Observer;

use MrVaco\NovaBlog\Models\Category;

class CategoryObserver
{
    public function created(Category $category): void {}
    
    public function updated(Category $category): void {}
    
    public function deleted(Category $category): void {}
    
    public function restored(Category $category): void {}
    
    public function forceDeleted(Category $category): void {}
}
