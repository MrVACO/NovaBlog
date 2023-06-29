<?php

namespace MrVaco\NovaBlog\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'mrvaco_blog_posts';
    
    protected $fillable = [
        'category_id',
        'name',
        'keywords',
        'title',
        'introductory',
        'content',
        'slug',
        'status',
        'creator_id',
        'updator_id',
        'published_at',
    ];
    
    protected $casts = [
        'category_id'  => 'integer',
        'status'       => 'integer',
        'creator_id'   => 'integer',
        'updator_id'   => 'integer',
        'published_at' => 'datetime',
    ];
}
