<?php

declare(strict_types = 1);

namespace MrVaco\NovaBlog\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \MrVaco\NovaBlog\Models\Post */
class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title'        => $this->title,
            'slug'         => $this->slug,
            'keywords'     => $this->keywords,
            'introductory' => $this->introductory,
            'content'      => $this->content,
            'image'        => $this->image,
            'creator'      => $this->creator?->name,
            'updator'      => $this->updator?->name,
            'published_at' => $this->published_at,
            'created_at'   => $this->created_at,
            
            'category' => new CategoryResource($this->whenLoaded('category')),
            
            'statistics' => StatisticsResource::make($this->statistic)
        ];
    }
}
