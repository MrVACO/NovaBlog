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
        'description',
        'status',
        'image',
        'creator_id',
        'updator_id',
    ];
    
    protected $casts = [
        'status'     => 'integer',
        'creator_id' => 'integer',
        'updator_id' => 'integer',
    ];
    
    public function scopeActiveList(Builder $query): Builder
    {
        return $query->where('status', StatusClass::ACTIVE()->id);
    }
    
    public function statistic(): HasOne
    {
        return $this->hasOne(CategoryStatistic::class, 'category_id');
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
        return $this->hasMany(Post::class, 'category_id');
    }
}
