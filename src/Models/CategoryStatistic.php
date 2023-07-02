<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryStatistic extends Model
{
    protected $table = 'mrvaco_blog_category_statistics';
    
    protected $primaryKey = 'category_id';
    
    public $timestamps = false;
    
    protected $fillable = [
        'category_id',
        'clicks'
    ];
    
    protected $casts = [
        'category_id' => 'integer',
        'clicks'      => 'integer',
    ];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
