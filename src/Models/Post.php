<?php

namespace MrVaco\NovaBlog\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use MrVaco\NovaGallery\Models\Gallery;

class Post extends Model
{
    protected $table = 'mrvaco_blog_posts';
    
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'keywords',
        'introductory',
        'content',
        'status',
        'image',
        'creator_id',
        'updator_id',
        'published_at',
        'gallery_id',
    ];
    
    protected $casts = [
        'category_id'  => 'integer',
        'status'       => 'integer',
        'creator_id'   => 'integer',
        'updator_id'   => 'integer',
        'published_at' => 'datetime',
        'gallery_id'   => 'integer',
    ];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function statistic(): HasOne
    {
        return $this->hasOne(PostStatistic::class, 'post_id');
    }
    
    public function creator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'creator_id');
    }
    
    public function updator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'updator_id');
    }
    
    public function gallery(): HasOne
    {
        return $this->hasOne(Gallery::class, 'id', 'gallery_id');
    }
}
