<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostStatistic extends Model
{
    protected $table = 'mrvaco_blog_post_statistics';
    
    protected $primaryKey = 'post_id';
    
    public $timestamps = false;
    
    protected $fillable = [
        'post_id',
        'clicks',
        'views',
    ];
    
    protected $casts = [
        'post_id' => 'integer',
        'clicks'  => 'integer',
        'views'   => 'integer',
    ];
    
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
