<?php

namespace MrVaco\NovaBlog\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
        'creator_id',
    ];
    
    protected $casts = [
        'status'     => 'integer',
        'creator_id' => 'integer',
    ];
    
    public function scopeActiveList(Builder $query): Builder
    {
        return $query->where('status', StatusClass::ACTIVE()->id);
    }
}
