<?php

namespace MrVaco\NovaBlog\Models;

use Illuminate\Database\Eloquent\Model;

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
}
