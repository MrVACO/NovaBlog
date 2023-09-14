<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Observer;

use MrVaco\NovaBlog\Models\Post;

class PostObserver
{
    public function created(Post $post): void {}
    
    public function updated(Post $post): void {}
    
    public function deleted(Post $post): void {}
    
    public function restored(Post $post): void {}
    
    public function forceDeleted(Post $post): void {}
}
