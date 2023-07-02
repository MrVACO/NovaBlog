<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Database\Seeders;

use Illuminate\Database\Seeder;
use MrVaco\NovaBlog\Models\Category;
use MrVaco\NovaStatusesManager\Classes\StatusClass;

class BlogCategorySeeder extends Seeder
{
    protected array $categories = [
        [
            'name'       => 'Uncategorized',
            'slug'       => 'uncategorized',
            'creator_id' => 1,
            'updator_id' => 1,
        ],
        [
            'name'       => 'News',
            'slug'       => 'news',
            'creator_id' => 1,
            'updator_id' => 1,
        ],
        [
            'name'       => 'Articles',
            'slug'       => 'articles',
            'creator_id' => 1,
            'updator_id' => 1,
        ],
    ];
    
    public function run(): void
    {
        foreach ($this->categories as $item)
        {
            Category::query()
                ->create(array_merge($item, [
                    'status' => StatusClass::ACTIVE()->id,
                ]))
                ->statistic()
                ->create();
        }
    }
}
