<?php

namespace MrVaco\NovaBlog\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use MrVaco\NovaGallery\Models\Gallery;
use MrVaco\NovaStatusesManager\Classes\StatusClass;

class Post extends Model
{
    protected $table = 'mrvaco_blog_posts';
    
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'keywords',
        'tags',
        'introductory',
        'content',
        'status',
        'image',
        'creator_id',
        'updator_id',
        'published_at',
        'gallery_id',
        'recommended',
    ];
    
    protected $casts = [
        'category_id'  => 'integer',
        'status'       => 'integer',
        'creator_id'   => 'integer',
        'updator_id'   => 'integer',
        'published_at' => 'datetime',
        'gallery_id'   => 'integer',
        'recommended'  => 'boolean',
    ];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
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
    
    public function scopeIsRecommended(Builder $query): Builder
    {
        return $query
            ->where('recommended', true)
            ->orderByDesc('published_at');
    }
    
    public function scopeIsActive(Builder $query): Builder
    {
        return $query->where('status', StatusClass::ACTIVE()->id);
    }
    
    public function scopeInCategory(Builder $query, int $id): Builder
    {
        return $query->where('category_id', $id);
    }
}
