<?php

namespace MrVaco\NovaBlog\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use MrVaco\NovaStatusesManager\Classes\StatusClass;

class Category extends Model
{
    protected $table = 'mrvaco_blog_categories';
    
    protected $fillable = [
        'name',
        'slug',
        'keywords',
        'tags',
        'description',
        'status',
        'image',
        'creator_id',
        'updator_id',
        'hidden',
    ];
    
    protected $casts = [
        'status'     => 'integer',
        'creator_id' => 'integer',
        'updator_id' => 'integer',
        'hidden'     => 'boolean',
    ];
    
    public function scopeActiveList(Builder $query): Builder
    {
        return $query->where('status', StatusClass::ACTIVE()->id);
    }
    
    public function creator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'creator_id');
    }
    
    public function updator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'updator_id');
    }
    
    public function posts(): HasMany
    {
        return $this
            ->hasMany(Post::class, 'category_id')
            ->orderBy('published_at', 'desc');
    }
}
